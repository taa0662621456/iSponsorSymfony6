# ===================
# Fixtures
# ===================
fixtures-load:
	docker compose exec app php bin/console doctrine:fixtures:load --no-interaction --purge-with-truncate

fixtures-append:
	docker compose exec app php bin/console doctrine:fixtures:load --no-interaction --append

# ===================
# Composer
# ===================
composer-update:
	docker compose exec app composer update --no-interaction

composer-reinstall:
	docker compose exec app composer clear-cache
	docker compose exec app composer install --no-interaction

# ===================
# Docker
# ===================
build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

logs:
	docker compose logs -f

# ===================
# QA
# ===================
lint:
	docker compose exec app php bin/console lint:container
	docker compose exec app vendor/bin/phpstan analyse

rector:
	docker compose exec app vendor/bin/rector process --dry-run

test:
	docker compose exec app vendor/bin/phpunit --testdox
