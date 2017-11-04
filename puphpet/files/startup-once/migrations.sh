#!/bin/bash

who
cd /var/www/html
chmod +x bin/cake
composer db-migrate-initial
composer db-migrate
composer db-seed