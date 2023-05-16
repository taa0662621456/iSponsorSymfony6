#!/bin/bash
SHELL := /bin/bash
f:
	clear
	# fixtures; not symfony console cache:clear
	symfony console doctrine:fixtures:load --purge-with-truncate -n
.PHONY: fixturesdev

fa:
	clear
	# fixtures; not symfony console cache:clear
	symfony console doctrine:fixtures:load --purge-with-truncate -n --append
.PHONY: fixturesappenddev

cu:
	composer update

lc:
	php bin/console lint:container

myunit:
	bin/phpunit --filter RoutingTest

ff:
	clear
	make appfixer
	clear
	make cu
	clear
	make lc
	clear
	symfony console doctrine:schema:drop --force --env=dev --full-database -n
	# force fixtures
	clear
	# process...
	pwd
	rm -r var/cache/dev/* -f
	rm -r var/cache/log/* -f
	rm -r migrations/* -f
	pwd
	make cc
	clear
	# process...
	symfony console doctrine:schema:update --force --env=dev
	clear
	# process...
	symfony console doctrine:fixtures:load --purge-with-truncate -n
	clear
	# process...
	symfony console make:migration -n
	symfony console doctrine:migration:migrate -n --env=dev
	make sso
	clear
	make rr
.PHONY: forcefixturesdev

rr:
	clear
	rm -r var/cache/dev/* -f
	rm -r var/cache/log/* -f
	symfony php bin/phpunit tests/Controller/UrlResponse200Test.php --do-not-cache-result --no-logging --colors always
.PHONY: testroutresponsedev

cc:
	clear
	rm -r var/cache/* -f
	symfony console doctrine:cache:clear-metadata
	symfony console doctrine:cache:clear-query
	symfony console doctrine:cache:clear-result
.PHONY: symfonycacheclear

sso:
	clear
	# process...
	symfony server:status
	clear
	# process...
	symfony server:stop
	clear
	# process...
	symfony server:start -d
	#symfony server:log --no-follow --no-tail --no-server-logs --no-app-logs
	# process...
	symfony open:local
	clear

appfixer:
	php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/entity

linter:
	# Linter
	symfony console lint:container
	symfony lint:yaml config/services.yaml --parse-tags
	vendor/bin/php-cs-fixer fix -v --dry-run --stop-on-violation
	vendor/bin/phpstan analyse --memory-limit=1G
.PHONY: linter

# Docker
up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down-clear manager-clear docker-pull docker-build docker-up manager-init
test: manager-test
test-coverage: manager-test-coverage
test-unit: manager-test-unit
test-unit-coverage: manager-test-unit-coverage

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

manager-init: manager-composer-install manager-assets-install manager-oauth-keys manager-wait-db manager-migrations manager-fixtures manager-ready

manager-clear:
	docker run --rm -v ${PWD}/manager:/app --workdir=/app alpine rm -f .ready

manager-composer-install:
	docker-compose run --rm manager-php-cli composer install

manager-assets-install:
	docker-compose run --rm manager-node yarn install
	docker-compose run --rm manager-node npm rebuild node-sass

manager-oauth-keys:
	docker-compose run --rm manager-php-cli mkdir -p var/oauth
	docker-compose run --rm manager-php-cli openssl genrsa -out var/oauth/private.key 2048
	docker-compose run --rm manager-php-cli openssl rsa -in var/oauth/private.key -pubout -out var/oauth/public.key
	docker-compose run --rm manager-php-cli chmod 644 var/oauth/private.key var/oauth/public.key

manager-wait-db:
	until docker-compose exec -T manager-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

manager-migrations:
	docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:migrate --no-interaction

manager-fixtures:
	docker-compose run --rm manager-php-cli php bin/console doctrine:fixtures:load --no-interaction

manager-ready:
	docker run --rm -v ${PWD}/manager:/app --workdir=/app alpine touch .ready

manager-assets-dev:
	docker-compose run --rm manager-node npm run dev

manager-test:
	docker-compose run --rm manager-php-cli php bin/phpunit

manager-test-coverage:
	docker-compose run --rm manager-php-cli php bin/phpunit --coverage-clover var/clover.xml --coverage-html var/coverage

manager-test-unit:
	docker-compose run --rm manager-php-cli php bin/phpunit --testsuite=unit

manager-test-unit-coverage:
	docker-compose run --rm manager-php-cli php bin/phpunit --testsuite=unit --coverage-clover var/clover.xml --coverage-html var/coverage

build-production:
	docker build --pull --file=manager/docker/production/nginx.docker --tag ${REGISTRY_ADDRESS}/manager-nginx:${IMAGE_TAG} manager
	docker build --pull --file=manager/docker/production/php-fpm.docker --tag ${REGISTRY_ADDRESS}/manager-php-fpm:${IMAGE_TAG} manager
	docker build --pull --file=manager/docker/production/php-cli.docker --tag ${REGISTRY_ADDRESS}/manager-php-cli:${IMAGE_TAG} manager
	docker build --pull --file=manager/docker/production/postgres.docker --tag ${REGISTRY_ADDRESS}/manager-postgres:${IMAGE_TAG} manager
	docker build --pull --file=manager/docker/production/redis.docker --tag ${REGISTRY_ADDRESS}/manager-redis:${IMAGE_TAG} manager
	docker build --pull --file=centrifugo/docker/production/centrifugo.docker --tag ${REGISTRY_ADDRESS}/centrifugo:${IMAGE_TAG} centrifugo

push-production:
	docker push ${REGISTRY_ADDRESS}/manager-nginx:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/manager-php-fpm:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/manager-php-cli:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/manager-postgres:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/manager-redis:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/centrifugo:${IMAGE_TAG}

deploy-production:
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'rm -rf docker-compose.yml .env'
	scp -o StrictHostKeyChecking=no -P ${PRODUCTION_PORT} docker-compose-production.yml ${PRODUCTION_HOST}:docker-compose.yml
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "REGISTRY_ADDRESS=${REGISTRY_ADDRESS}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_APP_SECRET=${MANAGER_APP_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_DB_PASSWORD=${MANAGER_DB_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_REDIS_PASSWORD=${MANAGER_REDIS_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_MAILER_URL=${MANAGER_MAILER_URL}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "MANAGER_OAUTH_FACEBOOK_SECRET=${MANAGER_OAUTH_FACEBOOK_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "STORAGE_BASE_URL=${STORAGE_BASE_URL}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "STORAGE_FTP_HOST=${STORAGE_FTP_HOST}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "STORAGE_FTP_USERNAME=${STORAGE_FTP_USERNAME}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "STORAGE_FTP_PASSWORD=${STORAGE_FTP_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "CENTRIFUGO_WS_HOST=${CENTRIFUGO_WS_HOST}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "CENTRIFUGO_API_KEY=${CENTRIFUGO_API_KEY}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "CENTRIFUGO_SECRET=${CENTRIFUGO_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose pull'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose up --build -d'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'until docker-compose exec -T manager-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:migrate --no-interaction'


phpunit:
	vendor/bin/phpunit

phpspec:
	vendor/bin/phpspec run --ansi --no-interaction -f dot

phpstan:
	vendor/bin/phpstan analyse

psalm:
	vendor/bin/psalm

behat-cli:
	vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="~@javascript&&@cli&&~@todo" || vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="~@javascript&&@cli&&~@todo" --rerun

behat-non-js:
	vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="~@javascript&&~@cli&&~@todo" || vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="~@javascript&&~@cli&&~@todo" --rerun

behat-js:
	vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="@javascript&&~@cli&&~@todo" || vendor/bin/behat --colors --strict --no-interaction -vvv -f progress --tags="@javascript&&~@cli&&~@todo" --rerun

install:
	composer install --no-interaction --no-scripts

frontend:
	yarn install --pure-lockfile
	yarn encore production
