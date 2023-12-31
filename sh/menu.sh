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
  echo -e " 8 Migration"
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
  1)
    echo -e "Go to routing"
    source ./sh/route.sh
    ;;
  2)
    echo -e "Go to Server"
    source ./sh/server.sh
    ;;
  3)
    echo -e "Go to Fixture"
    source ./sh/fixture.sh
    ;;
  4)
    echo -e "Go to Schema"
    source ./sh/schema.sh
    ;;
  5)
    echo -e "Patch to zip processing..."
    source ./sh/patch_ziper.sh
    ;;
  6)
    echo -e "Test menu"
    source ./sh/test.sh
    ;;
  7)
    echo -e "Docker menu"
    sh/docker.sh
    ;;
  8)
    echo -e "Migration menu"
    source ./sh/migration.sh
    ;;
  *) echo -e "\e[31m Incorrect\e[0m" ;;
  esac
  if [ $? -ne 0 ]; then
    read -p "Произошла ошибка. Нажмите Enter для продолжения."
  fi
done
