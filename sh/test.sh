while true; do
    clear
    echo -e "\e[1m"
    echo -e " iSponsor test:"
    echo -e " -------------------"
    echo -e "\e[0m \e[32m"
    echo -e " 1 Route 200"
    echo -e " 2 "
    echo -e " 3 "
    echo -e " 4 "
    echo -e " 5 "
    echo -e '\e[0m \e[1m'
    echo -e " ------------------------"
    echo -e "   Press Space for exit"

    echo -e '\e[0m \e[32m'

    read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

    trimmed_action=$(echo $action | xargs)

    if [ -z "$trimmed_action" ]; then
        bash
    fi

    case $action in
        1) echo -e "Go to routing..."
          symfony server:status
          symfony server:stop
          php bin/console cache:clear
          php bin/console cache:warmup --env=dev
          symfony server:start -d
          read -p 'Press Enter for continue routes status 200 testing ...'
          symfony php bin/phpunit tests/Controller/UrlResponse200Test.php --colors always
          exit 0
          ;;
        2) echo -e "Go to Server..."
          exit 0
          ;;
        3) echo -e "Go to Fixture..."
          exit
          ;;
        4) echo -e "Go to Schema..."
          exit
          ;;
        5) echo -e "Patch to zip processing..."
           exit
           ;;
        *) echo -e "\e[31m Incorrect\e[0m";;
    esac
done
