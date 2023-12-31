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
    echo -e "   Press Space for exit"

    echo -e '\e[0m \e[32m'

    read -r -n 1 -s -p " Enter action number or press Space for Exit:" action

    trimmed_action=$(echo $action | xargs)

    if [ -z "$trimmed_action" ]; then
        bash
    fi

    case $action in
        1) echo -e "Add..."
          php bin/console app:add-vendor
          read -p 'Press Enter for continue routes status 200 testing ...'
          exit
          ;;
        2) echo -e "Go to Server..."
          php bin/console app:list-vendors
          read -p 'Press Enter for continue routes status 200 testing ...'
          exit
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
