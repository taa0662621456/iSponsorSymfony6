#
# http://www.inanzzz.com/index.php/post/fr4t/creating-a-dockerised-symfony-application-and-a-makefile-based-build-script
# https://blog.theodo.com/2018/05/why-you-need-a-makefile-on-your-project/
#

# http://fabien.potencier.org/symfony4-best-practices.html
# https://speakerdeck.com/mykiwi/outils-pour-ameliorer-la-vie-des-developpeurs-symfony?slide=47
# https://blog.theodo.fr/2018/05/why-you-need-a-makefile-on-your-project/

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

SHELL := /bin/bash
# Setup ————————————————————————————————————————————————————————————————————————
#SHELL         = bash
PROJECT       = isponsor
EXEC_PHP      = php
REDIS         = redis-cli
GIT           = git
GIT_AUTHOR    = AlexTishchenko
SYMFONY       = $(EXEC_PHP) bin/console
SYMFONY_BIN   = ./symfony
COMPOSER      = $(EXEC_PHP) composer.phar
DOCKER        = docker-compose
BREW          = brew

install: composer.json ##
	composer install

cache-clear:
	@test -f bin/console && bin/console cache:clear --no-warmup || rm -rf var/cache/*
.PHONY: cache-clear

cache-warmup: cache-clear
	@test -f bin/console && bin/console cache:warmup || echo "cannot warmup the cache (needs symfony/console)"
.PHONY: cache-warmup


## Install fixtures with drop schema and step by step cache clear
app-install-fixtures: ## myInstall-test  install or update DB and load Fixtures
	@test -f bin/console && bin/console cache:clear --no-warmup || rm -rf var/cache/*
	bin/console doctrine:schema:drop && bin/console doctrine:database:drop
	@test -f bin/console && bin/console cache:clear --no-warmup || rm -rf var/cache/*
	bin/console doctrine:schema:update || bin/console doctrine:schema:update --force
	bin/console doctrine:fixtures:load
	@test -f bin/console && bin/console cache:clear --no-warmup || rm -rf var/cache/*
	@test -f bin/console && bin/console cache:warmup || echo "cannot warmup the cache (needs symfony/console)"
.PHONY: app-install-fixtures

	symfony cache:clear

tests:
	symfony console doctrine:fixtures:load -n
	symfony run bin/phpunit
.PHONY: tests
