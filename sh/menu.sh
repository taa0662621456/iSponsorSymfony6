#!/usr/bin/env bash
set -euo pipefail

while true; do
  clear
  echo -e "\e[1m"
  echo -e " iSponsor :"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Route"
  echo -e " 2 Server"
  echo -e " 3 Fixture"
  echo -e " 4 Schema"
  echo -e " 5 Patch to zip"
  echo -e " 6 Test"
  echo -e " 7 Docker"
  echo -e " 8 Migration"
  echo -e " 9 Composer"
  echo -e '\e[0m \e[1m'
  echo -e " ------------------------"
  echo -e "   Press Space for exit"
  echo -e '\e[0m \e[32m'

  read -r -n 1 -s -p " Enter action number or press Space for Exit:" action
  echo

  trimmed_action=$(echo "$action" | xargs)

  if [ -z "$trimmed_action" ]; then
    echo "Bye"
    exit 0
  fi

  case $trimmed_action in
    1) exec ./sh/route.sh ;;
    2) exec ./sh/server.sh ;;
    3) exec ./sh/fixture.sh ;;
    4) exec ./sh/schema.sh ;;
    5) exec ./sh/patch_ziper.sh ;;
    6) exec ./sh/test.sh ;;
    7) exec ./sh/docker.sh ;;
    8) exec ./sh/migration.sh ;;
    9) exec ./sh/composer.sh ;;
    *) echo "Unknown choice"; sleep 1 ;;
  esac

  if [ $? -ne 0 ]; then
    read -p "Произошла ошибка. Нажмите Enter для продолжения."
  fi
done
