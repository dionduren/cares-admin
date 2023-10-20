#!/bin/bash

# start service cron
service cron start

# start service supervisor
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

# start service apache2
apachectl -D FOREGROUND