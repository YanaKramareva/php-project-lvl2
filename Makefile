install:
	composer install

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 src bin tests

test:
	composer run-script test -- --coverage-clover build/logs/clover.xml




