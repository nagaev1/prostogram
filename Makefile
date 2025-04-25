start:
	docker compose -f dev.docker-compose.yml up -d

stop:
	docker compose -f dev.docker-compose.yml down

init-db:
	docker compose -f dev.docker-compose.yml exec -it php bash -c "php artisan migrate --force && php artisan storage:link && php artisan db:seed"

install-deps: install-backend-deps install-frontend-deps

install-backend-deps:
	docker run --rm -v $(shell pwd):/app -w /app -u 1000:1000 composer composer install --ignore-platform-reqs

install-frontend-deps:
	docker run --rm -v $(shell pwd):/app -w /app -u 1000:1000 node:22.0.0-alpine npm ci
