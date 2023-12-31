while true; do
  clear
  echo -e "\e[1m"
  echo -e " Database migration:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Create migration"
  echo -e " 2 Migration migrate"
  echo -e " 3 Migration rollback"
  echo -e " 4 Show migrations status"
  echo -e " 5 Execute specific migration"
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
    echo -e "Create migration process..."
    php bin/console doctrine:migrations:diff
    ;;
  2)
    echo -e "Migration migrate process..."
    php bin/console doctrine:migrations:migrate
    ;;
  3)
    echo -e "Migration rollback process..."
    php bin/console doctrine:migrations:migrate prev
    ;;
  4)
    echo -e "Show migrations status..."
    php bin/console doctrine:migrations:status
    read -p "Нажмите Enter для продолжения."

    ;;
  5)
    echo -e "Execute specific migration. Enter the migration name"
    read -p 'Enter migration version: ' version
    php bin/console doctrine:migrations:execute $version
    ;;
  0)
    echo -e "Go back to main menu"
    source ./sh/menu.sh
    ;;
  *)
    echo -e "\e[31m Incorrect\e[0m"
    read -p 'Press Enter to continue ...'
    ;;
  esac
  if [ $? -ne 0 ]; then
    read -p "Произошла ошибка. Нажмите Enter для продолжения."
  fi
done
