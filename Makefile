install:
	composer install

gendiff:
	./bin/gendiff

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 src bin



