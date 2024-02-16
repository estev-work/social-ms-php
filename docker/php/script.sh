#!/bin/bash
mkdir -pv /var/www/html/public/storage;
chown www-data:www-data -R /var/www/html/public/storage;
chmod 0755 -R /var/www/html/public/storage;

mkdir -pv /var/www/html/storage/logs;
mkdir -pv /var/www/html/storage/logs/supervisor;
chown www-data:www-data -R /var/www/html/storage/logs;
chmod 0755 -R /var/www/html/storage/logs;

/usr/bin/supervisord -c /etc/supervisor/supervisord.conf;