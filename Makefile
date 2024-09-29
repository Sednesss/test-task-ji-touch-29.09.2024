.PHONY: dev init-app start stop down routes-list cache-clear tinker nginx mysql laravel

dev:
	docker-compose up -d --build

init-app:
	docker exec -it test_task_jitouch_app php artisan key:generate
	docker exec -it test_task_jitouch_app php artisan migrate --seed

start:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

tinker:
	docker exec -it test_task_jitouch_app php artisan tinker

nginx:
	docker exec -it test_task_jitouch_webserver sh

mysql:
	docker exec -it test_task_jitouch_db bash

laravel:
	docker exec -it test_task_jitouch_app bash

routes-list:
	docker exec -it test_task_jitouch_app php artisan route:list

cache-clear:
	docker exec -it test_task_jitouch_app php artisan cache:clear
	docker exec -it test_task_jitouch_app php artisan config:clear
	docker exec -it test_task_jitouch_app php artisan route:clear

test:
	docker exec -it test_task_jitouch_app php artisan test