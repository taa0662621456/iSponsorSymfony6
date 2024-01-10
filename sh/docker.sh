while true; do
  clear
  echo -e "\e[1m"
  echo -e " iSponsor Docker:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Docker Up"
  echo -e " 2 Docker Down --remove-orphans"
  echo -e " 3 Docker Down and clear -v --remove-orphans"
  echo -e " 4 Docker Pull"
  echo -e " 5 Docker Build"
  echo -e " 6 "
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
    echo -e "Docker Up processing..."
    docker-compose --profile web up -d
    ;;
  2)
    echo -e "Docker Down processing..."
    docker-compose down --remove-orphans
    ;;
  3)
    echo -e "Docker Down and clear processing..."
    docker-compose down -v --remove-orphans
    ;;
  4)
    echo -e "Docker Pull processing..."
    docker-compose pull
    ;;
  5)
    echo -e "Docker Build processing..."
    docker-compose build
    ;;
  6)
    echo -e "..."
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
