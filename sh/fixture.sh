while true; do
    clear
    echo -e "\e[1m"
    echo -e " Fixture PowerCycle:"
    echo -e " -------------------"
    echo -e "\e[0m \e[32m"
    echo -e " 1 Fixture PowerCycle"
    echo -e " 2 Add new Fixture"
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
            echo -e "Fixture Restarting..."
            symfony console doctrine:schema:update --complete --force
            read -p 'Press Enter for continue...'
            symfony console doctrine:fixtures:load --purge-with-truncate -n
            read -p 'Press Enter for continue...'
            ;;
        2) clear
            echo -e "Fixture append..."
            symfony console doctrine:fixtures:load --append -n
            read -p 'Press Enter for continue...'
            ;;

         0) clear
           echo 'go back'
            sh/menu.sh

            ;;
        *) echo -e "\e[31m Incorrect\e[0m";;
    esac
done
