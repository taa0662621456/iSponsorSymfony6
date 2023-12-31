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
    echo -e '\e[0m \e[32m'

    read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

    trimmed_action=$(echo $action | xargs)

    if [ -z "$trimmed_action" ]; then
        bash
    fi

    case $action in
        1) clear
            echo -e "Server Restarting..."
            symfony server:status
            symfony server:stop
            symfony server:start -d
            ;;
        2) clear
            echo -e "Server Restarting and CacheCleaning..."
            symfony server:status
            symfony server:stop
            php bin/console cache:clear
            php bin/console cache:warmup --env=dev
            symfony server:start -d
            read -p 'Press Enter for continue...'
            ;;
          3) clear
            echo -e "Server PowerCircle with SchemaUpdate..."
            symfony server:status
            symfony server:stop
            read -p 'Press Enter for continue...'
            symfony console doctrine:schema:update --complete --force
            read -p 'Press Enter for continue...'
            symfony server:start -d
            read -p 'Press Enter for continue...'
            ;;
         0) clear
           echo 'go back'
            sh/menu.sh
            ;;
        *) echo -e "\e[31m Incorrect\e[0m";;
    esac
done
