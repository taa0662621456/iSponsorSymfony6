#!/usr/bin/env bash
set -euo pipefail

LOG_FILE="logs/actions.log"
ERR_FILE="logs/errors.log"
mkdir -p logs
timestamp=$(date '+%Y-%m-%d %H:%M:%S')
EXIT_CODE=0

clear
echo "Symfony Cache Management"
echo "------------------------"
echo "1) Clear cache"
echo "2) Warmup cache"
echo "Space) Exit"

read -r -n 1 -s -p "Choice: " action
echo

case $action in
  1) echo "[$timestamp] Cache clear" >> "$LOG_FILE"
     php bin/console cache:clear 2>>"$ERR_FILE" || EXIT_CODE=$? ;;
  2) echo "[$timestamp] Cache warmup" >> "$LOG_FILE"
     php bin/console cache:warmup 2>>"$ERR_FILE" || EXIT_CODE=$? ;;
  *) echo "[$timestamp] Exit from Cache menu" >> "$LOG_FILE"
     echo "Bye"; exit 0 ;;
esac

echo "[$timestamp] Exit code: $EXIT_CODE" >> "$LOG_FILE"
exit $EXIT_CODE
