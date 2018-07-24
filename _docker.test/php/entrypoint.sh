#!/bin/bash

echo "Launching application"
cd /srv/www/application && php bin/console cache:clear --no-debug --env=test
echo ".. cache cleaned"

[ -d ./vendor ] && chown -Rh www-data:www-data ./vendor
chown -Rh www-data:www-data /srv/www/application/var
chmod -R o+w /srv/www/application/var
chmod -R a+x /srv/www/application/bin/console
echo ".. permissions set"

exec "php-fpm"
