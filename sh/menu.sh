while true; do
    clear
    echo -e "\e[1m"
    echo -e " iSponsor :"
    echo -e " -------------------"
    echo -e "\e[0m \e[32m"
    echo -e " 1 Route"
    echo -e " 2 Server"
    echo -e " 3 Fixture"
    echo -e " 4 Schema"
    echo -e " 5 Patch to zip"
    echo -e " 6 Test"
    echo -e " 7 Docker"
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
        1) echo -e "Go to routing"
          sh/route.sh
          exit 0
          ;;
        2) echo -e "Go to Server"
          sh/server.sh
          exit 0
          ;;
        3) echo -e "Go to Fixture"
          sh/fixture.sh
          exit
          ;;
        4) echo -e "Go to Schema"
          sh/schema.sh
          exit
          ;;
        5) echo -e "Patch to zip processing..."
           sh/patch_ziper.sh
           exit
           ;;
        6) echo -e "Test menu"
           sh/test.sh
           exit
           ;;
       7) echo -e "Docker menu"
          sh/docker.sh
          exit
          ;;
        *) echo -e "\e[31m Incorrect\e[0m";;
    esac
done
