#!/usr/bin/env bash
set -euo pipefail

clear
echo "Deployment Menu"
echo "----------------"
echo "1) Deploy staging"
echo "2) Deploy production"
echo "Space) Exit"

read -r -n 1 -s -p "Choice: " action
echo

case $action in
  1) echo "Deploying to staging..." && exec git push origin develop ;;
  2) echo "Deploying to production..." && exec git push origin main ;;
  *) echo "Bye"; exit 0 ;;
esac
