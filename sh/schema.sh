while true; do
  clear
  echo -e "\e[1m"
  echo -e " Schema PowerCycle:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Schema validation"
  echo -e " 2 Schema update"
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
    clear
    echo -e "Schema validation..."
    symfony console doctrine:schema:validate
    ;;
  2)
    clear
    echo -e "Schema update..."
    symfony console doctrine:schema:update --complete --force
    symfony console doctrine:schema:validate
    ;;
  0)
    echo 'go back'
    source ./sh/menu.sh
    ;;
  *) echo -e "\e[31m Incorrect\e[0m" ;;
  esac
  if [ $? -ne 0 ]; then
    read -p "Произошла ошибка. Нажмите Enter для продолжения."
  fi
done
