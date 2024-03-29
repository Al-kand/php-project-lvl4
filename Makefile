start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	php artisan migrate --force
	npm install
	npm run build
	
log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs -- --standard=PSR2 routes app tests


phpstan:
	vendor/bin/phpstan  analyse -c phpstan.neon