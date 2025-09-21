while true; do
  clear
  echo -e "\e[1m"
  echo -e " Composer :"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Composer Install"
  echo -e " 2 Composer Update"
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
    echo -e "Composer Install..."
    symfony composer install
    ;;
  2)
    echo -e "Composer Update..."
    symfony composer update
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
