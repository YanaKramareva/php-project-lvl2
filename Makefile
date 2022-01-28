install:
	composer install

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests -- --coverage-text

coverage:
	composer exec --verbose phpunit tests -- --coverage-html tests/coverage/index.html




