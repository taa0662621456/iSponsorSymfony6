while true; do
  clear
  echo -e "\e[1m"
  echo -e " iSponsor commands:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 User add"
  echo -e " 2 List Vendors"
  echo -e " 3 "
  echo -e " 4 "
  echo -e " 5 "
  echo -e '\e[0m \e[1m'
  echo -e " ------------------------"
  echo -e " 0 Exit to main menu... "
  echo -e "   Press Space for exit"

  echo -e '\e[0m \e[32m'

  read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

  trimmed_action=$(echo $action | xargs)

  if [ -z "$trimmed_action" ]; then
    bash
  fi

  case $action in
  1)
    echo -e "Add..."
    php bin/console app:add-vendor
    ;;
  2)
    echo -e "Go to Server..."
    php bin/console app:list-vendors
    ;;
  3)
    echo -e "Go to Fixture..."
    ;;
  4)
    echo -e "Go to Schema..."
    ;;
  5)
    echo -e "Patch to zip processing..."
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
