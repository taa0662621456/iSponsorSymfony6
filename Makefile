


run:
	@docker run --rm -it \
		-v $(PWD)/public:/usr/share/nginx/html \
		--workdir /usr/share/nginx/html \
		-p 8088:80 \
		alpine-php-fpm:latest
.PHONY: run

compose:
	@docker-compose -f docker-compose.yml up
.PHONY: compose


buildx-fpm-80:
	@echo "Building PHP 8.0 Docker images (linux/amd64,linux/arm64)..."
	@docker buildx build -t docker/php-fpm:8.0 --platform linux/amd64,linux/arm64 -f 8.0-fpm/Dockerfile .
.PHONY: build-fpm-80

prune:
	@docker container ps prune
	@docker container ps -a

.PHONY: prune

install:
	@echo "TODO: будем инсталлировать (собирать и разворачивать контейнер) с нашим приложением"

.PHONY: install
