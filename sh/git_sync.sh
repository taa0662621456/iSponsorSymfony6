#!/usr/bin/env bash
set -euo pipefail

clear
echo "Git Sync"
echo "---------"
echo "1) Pull"
echo "2) Pull with rebase"
echo "3) Push"
echo "Space) Exit"

read -r -n 1 -s -p "Choice: " action
echo

case $action in
  1) exec git pull origin master ;;
  2) exec git pull --rebase origin master ;;
  3) exec git push origin master ;;
  *) echo "Bye"; exit 0 ;;
esac
