install:
	composer install

dump:
	composer dump-autoload

test:
	composer exec phpunit
