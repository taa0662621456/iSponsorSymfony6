# Workflow Command Tests

This folder contains **unit tests for workflow commands**.  
Each workflow command orchestrates multiple sub-commands, and these tests ensure both the orchestration and the console output remain correct.

---

## Structure
- VendorOnboardCommandTest.php  
- OrderCloseCommandTest.php  
- RefundWorkflowCommandTest.php  
- CampaignStartCommandTest.php  
- SystemMaintainCommandTest.php  

---

## Testing Approach
1. **MockApplication & MockCommand**  
   - `MockApplication` overrides `find()` to return `MockCommand`.  
   - `MockCommand` logs execution instead of running real logic.  
   - This ensures tests are isolated and fast.

2. **Call Assertions**  
   - Each test checks that the workflow command invokes the expected sub-commands in the right order.

3. **Snapshot Testing**  
   - Using `BufferedOutput`, each test captures the command’s output.  
   - The actual output is compared against a fixed snapshot (heredoc `<<<SNAP`).  
   - If the output changes, the test fails — this prevents regressions in CLI output.

---

## Running the Tests
From project root:

```bash
./vendor/bin/phpunit tests/Command/Workflow
```

---

## Example Assertion
```php
$actual = trim($output->fetch());
$expected = <<<SNAP
Closing order 123
Mock executed: app:order:ship
Mock executed: app:invoice:generate
SNAP;

$this->assertEquals($expected, $actual);
```

---

## Best Practices
- Keep snapshots **up to date**:  
  If a command’s expected output legitimately changes, update the snapshot in the test file.  
- Extend `MockApplication` if new sub-commands are added.  
- Use these tests as a **safety net** for refactoring business workflows.
