while true; do
  clear
  echo -e "\e[1m"
  echo -e "   Routes Checker:"
  echo -e "   -------------------"
  echo -e "\e[0m \e[32m"
  echo -e "   1 All routs"
  echo -e "   2 Check Route access just by RouteName (guest access)"
  echo -e "   3 Check Route access by RouteName and userName"
  echo -e "   ------------------------"
  echo -e "   4 All routs by filtering (partial) RouteName"
  echo -e "   5 All routs by filtering (exact) RouteName"
  echo -e '\e[0m \e[1m'
  echo -e "   ------------------------"
  echo -e "   0 Go back to main menu"
  echo -e '\e[0m \e[32m'

  read -r -n 1 -s -p "    Enter action number or press Space for Exit:" action

  trimmed_action=$(echo $action | xargs)

  if [ -z "$trimmed_action" ]; then
    bash
  fi

  case $action in
  1)
    echo -e "    Routes..."
    php bin/console debug:router
    ;;
  2)
    echo -e "    Check Route access by routeName (guest access)..."
    read -p "    Enter Route Name: " routeName
    php bin/console debug:router --format=md --show-controllers $routeName
    read -p "   Press Enter to continue..."
    ;;
  3)
    echo -e "    Check Route access by routeName and user..."
    read -p "    Enter Route Name: " routeName
    read -p "    Enter User Name: " userName
    php bin/console debug:router --format=md --show-controllers $routeName $userName
    ;;
  4)
    echo ''
    read -p "    Enter part of Route Name: " partialRouteName
    php bin/console debug:router --format=md --show-controllers | grep -E "($partialRouteName)|(^ --------------)|(^ Name)"
    ;;
  5)
    echo -e "Search Route by exact name..."
    read -p "Enter exact Route Name: " exactRouteName
    php bin/console debug:router --format=md --show-controllers | grep -E "($exactRouteName)|(^ --------------)|(^ Name)" | awk '{if (/^ /) {print "\t" $0} else if (/^ -/) {print "\n\t" $0} else {print}}'
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
