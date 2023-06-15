init:
	cp docker/.env-local-example .env
	cp docker/docker-compose-local.yml docker-compose.yml
	docker-compose up -d
	make composer
	make migrate
	make seed
	@docker exec laravel chmod 777 -R .
deploy: 
	git pull
	cp docker/.env-production-example .env
	cp docker/docker-compose-prod.yml docker-compose.yml
	docker-compose up -d app
	make composer
	make migrate
deploy-stagging: 
	git pull
	cp docker/.env-local-example .env
	docker-compose up -d app
	make composer
	make migrate
down:
	@docker-compose down -v	
migrate:
	@echo "Running migrations"
	@echo "------------------------"
	@docker exec laravel php artisan migrate --force
seed:
	@echo "Running seed"
	@echo "------------------------"
	@docker exec laravel php artisan db:seed
rollback:
	@echo "Rollback migrations"
	@echo "------------------------"
	@docker exec laravel php artisan migrate:rollback --force
composer:
	@echo "Running composer clear-cache"
	@echo "------------------------"
	@docker exec laravel composer clear-cache
	@echo "Running composer self-update"
	@echo "------------------------"
	@docker exec laravel composer self-update
	@echo "Running composer install --no-interaction"
	@echo "------------------------"
	@docker exec laravel composer install --no-interaction
.PHONY: clean test code-sniff init