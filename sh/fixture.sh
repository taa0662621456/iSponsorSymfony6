while true; do
  clear
  echo -e "\e[1m"
  echo -e " Fixture setCycle:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Fixture PowerCycle"
  echo -e " 2 Append new Fixture"
  echo -e " 3 Profile avatars downloader"
  echo -e '\e[0m \e[1m'
  echo -e " ------------------------"
  echo -e " 0 Exit to main menu... "
  echo -e '\e[0m \e[32m'

  read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

  trimmed_action=$(echo $action | xargs)

  if [ -z "$trimmed_action" ]; then
    bash
  fi

  case $action in
  1)
    echo -e "Fixture Restarting..."
    symfony console doctrine:fixtures:load --purge-with-truncate --no-interaction
    ;;
  2)
    echo -e "Fixture append..."
    symfony console doctrine:fixtures:load --append --no-interaction
    ;;

  3)
    echo 'Profile avatars downloading process... Input the Count of avatars'
    read COUNT

    if ! [[ "$COUNT" =~ ^[0-9]+$ ]]; then
      echo -e "\e[31m Incorrect\e[0m"
      exit 1
    fi

    php bin/console app:avatar-download --count=$COUNT
    ;;

  0)
    echo -e "Go back to main menu"
    source ./sh/menu.sh
    ;;

  *) echo -e "\e[31m Incorrect\e[0m" ;;
  esac
    if [ $? -ne 0 ]; then
      read -p "Произошла ошибка. Нажмите Enter для продолжения."
    fi
done
