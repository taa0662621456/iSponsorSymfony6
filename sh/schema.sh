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
    echo -e '\e[0m \e[32m'

    read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

    trimmed_action=$(echo $action | xargs)

    if [ -z "$trimmed_action" ]; then
        bash
    fi

    case $action in
        1) clear
            echo -e "Schema validation..."
            symfony console doctrine:schema:validate
            read -p 'Press Enter for continue...'
            ;;
        2) clear
            echo -e "Schema update..."
            php bin/console doctrine:migrations:diff
            symfony console doctrine:schema:update --complete --force
            symfony console doctrine:cache:clear-metadata
            symfony console doctrine:cache:clear-result
            symfony console doctrine:cache:clear-query
            symfony console cache:clear
            clear
            symfony console doctrine:schema:validate
            read -p 'Press Enter for continue...'
            ;;
         0) clear
           echo 'go back'
            sh/menu.sh
            return 0

            ;;
        *) echo -e "\e[31m Incorrect\e[0m";;
    esac
done
