#!/usr/bin/env bash
set -euo pipefail

LOG_FILE="logs/actions.log"
ERR_FILE="logs/errors.log"
mkdir -p logs
timestamp=$(date '+%Y-%m-%d %H:%M:%S')
EXIT_CODE=0

clear
echo "Composer Menu"
echo "-------------"
echo "1) Install"
echo "2) Update"
echo "3) Dump autoload"
echo "Space) Exit"

read -r -n 1 -s -p "Choice: " action
echo

case $action in
  1) echo "[$timestamp] Composer install" >> "$LOG_FILE"
     composer install 2>>"$ERR_FILE" || EXIT_CODE=$? ;;
  2) echo "[$timestamp] Composer update" >> "$LOG_FILE"
     composer update 2>>"$ERR_FILE" || EXIT_CODE=$? ;;
  3) echo "[$timestamp] Composer dump-autoload" >> "$LOG_FILE"
     composer dump-autoload 2>>"$ERR_FILE" || EXIT_CODE=$? ;;
  *) echo "[$timestamp] Exit from Composer menu" >> "$LOG_FILE"
     echo "Bye"; exit 0 ;;
esac

echo "[$timestamp] Exit code: $EXIT_CODE" >> "$LOG_FILE"
exit $EXIT_CODE
