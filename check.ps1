param(
    [string]$Root = ".\src",
    [string]$ReportDir = ".",
    [string]$ErrorLog = ".\var\log\dev.log",        # Symfony / PHP errors
    [string]$StaticAnalysisLog = ".\phpstan.log",   # PHPStan / Psalm
    [string]$PhpUnitLog = ".\phpunit.log",          # PHPUnit log (если есть)
    [switch]$Ansi,
    [string]$GitHubRepoUrl = "https://github.com/taa0662621456/iSponsorSymfony6/blob"
)

$ErrorActionPreference = 'Stop'

# Ensure report dir exists
if (-not (Test-Path -LiteralPath $ReportDir)) {
    [void][System.IO.Directory]::CreateDirectory($ReportDir)
}
$ReportDir = (Resolve-Path -LiteralPath $ReportDir).Path

# Build file names
$timestamp   = Get-Date -Format "yyyyMMdd_HHmmss"
$ReportFile  = Join-Path $ReportDir "report_$timestamp.txt"
$PromptFile  = Join-Path $ReportDir "prompt_$timestamp.txt"

# Collect lines
$Report  = New-Object System.Collections.Generic.List[string]
$Prompt  = New-Object System.Collections.Generic.List[string]
$Stats   = @{}
$Total   = 0

function Add-Report([string]$text) { $script:Report.Add($text) }
function Add-Prompt([string]$text) { $script:Prompt.Add($text) }

# Try to get git context
$GitCommitHash = ""
$GitBranch = ""
try {
    $GitCommitHash = (git rev-parse HEAD).Trim()
    $GitBranch = (git rev-parse --abbrev-ref HEAD).Trim()
} catch {
    $GitCommitHash = "HEAD"
    $GitBranch = "unknown"
}

function Get-SectionReport([string]$Title, [string]$Path) {
    Add-Report ("=== {0} ===" -f $Title)
    Add-Prompt ("=== {0} ===" -f $Title)

    if (Test-Path -LiteralPath $Path) {
        $files = Get-ChildItem -LiteralPath $Path -Recurse -File -Filter *.php -ErrorAction SilentlyContinue
        $count = ($files | Measure-Object).Count
        $script:Stats[$Title] = $count
        $script:Total += $count
        Add-Report ("Found: {0} file(s)" -f $count)

        foreach ($f in $files) {
            # Report: локальный путь
            Add-Report $f.FullName

            # Prompt: GitHub ссылка
            $relative = $f.FullName.Substring((Resolve-Path $Root).Path.Length).TrimStart('\')
            $url = "$GitHubRepoUrl/$GitCommitHash/$relative" -replace '\\','/'
            Add-Prompt $url
        }
    } else {
        $script:Stats[$Title] = 0
        Add-Report ("No such directory: {0}" -f $Path)
    }
    Add-Report ""
    Add-Prompt ""
}

# === Header ===
Add-Report ("=== Project structure report ({0}) ===" -f $timestamp)
Add-Report ""

$PromptHeader = @"
=== Prompt for ChatGPT ===
Please analyze the following errors and files.
Take files from repository (latest version after push).

Current branch: $GitBranch
Commit: $GitCommitHash

"@
Add-Prompt $PromptHeader

# === Errors section ===
Add-Prompt "=== Errors (logs / stack traces / phpstan / phpunit) ==="

if (Test-Path $ErrorLog) {
    Add-Prompt "--- Symfony / PHP errors ---"
    Get-Content $ErrorLog -Tail 50 | ForEach-Object { Add-Prompt $_ }
}
if (Test-Path $StaticAnalysisLog) {
    Add-Prompt ""
    Add-Prompt "--- PHPStan / Psalm ---"
    Get-Content $StaticAnalysisLog -Tail 50 | ForEach-Object { Add-Prompt $_ }
}
if (Test-Path $PhpUnitLog) {
    Add-Prompt ""
    Add-Prompt "--- PHPUnit ---"
    Get-Content $PhpUnitLog -Tail 50 | ForEach-Object { Add-Prompt $_ }
}
Add-Prompt ""
Add-Prompt "=== Project structure and files ==="

# === Scan sections ===
Get-SectionReport "Entities"       (Join-Path $Root "Entity")
Get-SectionReport "Commands"       (Join-Path $Root "Command")
Get-SectionReport "Controllers"    (Join-Path $Root "Controller")
Get-SectionReport "EventListeners" (Join-Path $Root "EventListener")
Get-SectionReport "Services"       (Join-Path $Root "Service")

# === Summary (только в report) ===
Add-Report "=== Summary ==="
foreach ($k in $Stats.Keys) { Add-Report ("{0}: {1}" -f $k, $Stats[$k]) }
Add-Report ("TOTAL: {0}" -f $Total)
Add-Report ""

# === Footer for Prompt ===
$PromptFooter = @"
=== Analysis focus ===
- Architecture (services, traits, SOLID, duplication)
- Code quality (type hints, nullable, PHP 8.3 features)
- Integrations (Symfony best practices, Doctrine mapping)
- Testing (unit, functional, e2e coverage)

Provide a technical code review, suggest fixes and improvements.
"@
Add-Prompt $PromptFooter

# === Encoding ===
if ($Ansi) {
    $enc   = [System.Text.Encoding]::GetEncoding(1251)
    $encNm = "Windows-1251 (ANSI)"
} else {
    $enc   = New-Object System.Text.UTF8Encoding($true)   # UTF-8 with BOM
    $encNm = "UTF-8 with BOM"
}

# === Write files ===
[System.IO.File]::WriteAllLines($ReportFile, $Report.ToArray(), $enc)
[System.IO.File]::WriteAllLines($PromptFile, $Prompt.ToArray(), $enc)

$fullReport = (Resolve-Path -LiteralPath $ReportFile).Path
$fullPrompt = (Resolve-Path -LiteralPath $PromptFile).Path
Write-Host ("Report saved: {0}  [Encoding: {1}]" -f $fullReport, $encNm)
Write-Host ("Prompt saved: {0}  [Encoding: {1}]" -f $fullPrompt, $encNm)
