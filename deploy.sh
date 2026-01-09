#!/bin/bash

cd /home/u427543033/domains/jhefferson.com/public_html

php artisan config:clear;
php artisan cache:clear;
php artisan view:clear;
php artisan route:clear;
php artisan optimize;
