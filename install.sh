#!/bin/bash

bin/console doctrine:database:drop --force
bin/console doctrine:database:create
#bin/console doctrine:database:update --force


bin/console doctrine:migrations:migrate -n
bin/console doctrine:fixtures:load -n
