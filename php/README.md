# PHP Implementation
## Requirements
php7+
phpive

## Install dependencies
phive install

## Generate Autoloader
./tools/phpab -c -o src/autoload.inc.php src

## Unit Testing
./tools/phpunit --bootstrap src/autoload.inc.php --testdox tests
