# current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh

start: docker/start-development
stop: docker/stop-development

# Docker
docker/start-development:
	@docker network create ddd_network
	@docker-compose up -d --build --force-recreate

docker/stop-development:
	@docker-compose down
	@docker network rm ddd_network

# Composer
composer/install:
	@docker-compose exec php composer install
	@docker-compose exec php php bin/console cache:clear

# Project
init:
	@docker-compose exec php php bin/console doctrine:database:drop --if-exists --force
	@docker-compose exec php php bin/console doctrine:database:create
	@docker-compose exec php php bin/console doctrine:schema:create
	# @docker-compose exec php php bin/console doctrine:migrations:diff
	# @docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction
	@docker-compose exec php php bin/console doctrine:fixtures:load -n --group=app --group=dev

lint:
	@docker-compose exec php php bin/console doctrine:schema:validate
	@docker-compose exec php composer cscheck
	@docker-compose exec php composer csfix
	@docker-compose exec php composer phpstan

test:
	# @docker-compose exec php bin/phpunit --testdox tests/