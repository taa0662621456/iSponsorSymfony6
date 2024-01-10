while true; do
  clear
  echo -e "\e[1m"
  echo -e " Server PowerCycle:"
  echo -e " -------------------"
  echo -e "\e[0m \e[32m"
  echo -e " 1 Just Server PowerCycle"
  echo -e " 2 Server, CacheClean and CacheWarmUp PowerCycle"
  echo -e " 3 Server, Schema Delete, CacheClean and CacheWarmUp PowerCycle"
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
    echo -e "Server Restarting..."
    symfony server:stop
    symfony server:start -d
    ;;
  2)
    echo -e "Server Restarting and CacheCleaning..."
    symfony server:stop
    php bin/console cache:clear
    php bin/console cache:warmup --env=dev
    symfony server:start -d
    ;;
  3)
    echo -e "Server PowerCircle with SchemaUpdate..."
    symfony server:stop
    symfony console doctrine:schema:update --complete --force
    symfony server:start -d
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
