#!/usr/bin/env bash
set -euo pipefail

clear
echo "Logs Menu"
echo "---------"
echo "1) Symfony server logs"
echo "2) Docker logs"
echo "Space) Exit"

read -r -n 1 -s -p "Choice: " action
echo

case $action in
  1) exec symfony server:log ;;
  2) exec docker-compose logs -f ;;
  *) echo "Bye"; exit 0 ;;
esac
