#!/bin/sh
set -e

umask 0002

echo "  - Running application"

## Start nginx server
echo "  - Start nginx ..."
/etc/init.d/nginx start

## Start nginx server & output logs to std out
echo "  - Start php-fpm ..."

echo ""
exec 'php-fpm' '-F'