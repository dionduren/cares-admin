#!/bin/sh
set -eu

ENV_FILE=".env"

composer install

php artisan serve --host=0.0.0.0 --port 80