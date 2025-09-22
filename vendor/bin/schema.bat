@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../api-platform/schema-generator/bin/schema
php "%BIN_TARGET%" %*
