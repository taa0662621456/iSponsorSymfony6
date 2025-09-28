#!/usr/bin/env bash
set -euo pipefail

LOG_FILE="logs/actions.log"
mkdir -p logs

clear
echo "Action History"
echo "--------------"

if [ ! -f "$LOG_FILE" ]; then
  echo "Лог пока пуст."
  exit 0
fi

# Показать последние 50 строк
tail -n 50 "$LOG_FILE"

echo
echo "--------------------------"
echo "Enter - продолжить, C - скопировать весь лог, Space - выйти"

read -r -n 1 -s action
echo

case $action in
  "")  exit 0 ;;   # Enter → просто выход
  " ") exit 0 ;;   # Space → выход
  "C"|"c")
       cat "$LOG_FILE" | xclip -selection clipboard 2>/dev/null || \
       cat "$LOG_FILE" | pbcopy 2>/dev/null || \
       echo "Скопировать не удалось (нет утилиты xclip/pbcopy). Содержимое выше."
       ;;
esac
