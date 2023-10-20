# NON MAC M1
FROM php:8.1-apache

# FOR MAC M1
#FROM --platform=linux/amd64 php:8.0.2-apache 

LABEL MAINTAINER="Dion Duren"

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/apache.ini $PHP_INI_DIR/conf.d/
COPY .docker/openssl.cnf /etc/ssl/openssl.cnf
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf


WORKDIR /var/www/html

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
  apt-utils \
  curl \
  gnupg \
  locales \
  apt-transport-https \
  zlib1g-dev \
  libzip-dev \
  unzip \
  libcurl4-openssl-dev \
  pkg-config \
  libssl-dev \
  libxml2-dev \
  nano \
  supervisor

# RUN apt-get update \
#   && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
#   && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
#   && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen \
#   && apt-get update \
#   && ACCEPT_EULA=Y apt-get install -y --no-install-recommends unixodbc-dev msodbcsql17 mssql-tools

RUN \
  apt-get update && \
  apt-get install libldap2-dev -y && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
  docker-php-ext-install ldap

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  && docker-php-ext-configure gd \
  && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install mysqli pdo_mysql zip xml

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y apt-transport-https

# RUN pecl install sqlsrv pdo_sqlsrv && \
#   echo "extension=sqlsrv.so" >> /usr/local/etc/php/conf.d/sqlsrv.ini && \
#   echo "extension=pdo_sqlsrv.so" >> /usr/local/etc/php/conf.d/sqlsrv.ini


RUN apt-get autoremove -y && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN usermod -u 1000 www-data

RUN a2enmod ssl && a2enmod rewrite && service apache2 restart

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer install --no-interaction

RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@8.9.0 -g && \
    npm install n -g && \
    n latest
# RUN npm install && npm run prod

RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 775 {} \;
RUN find /var/www/html -type f -exec chmod 0664 {} \;



RUN apt-get update && apt-get -y install cron

# Copy crontab file to the cron.d directory
# COPY .docker/php/crontab /etc/cron.d/crontab

# Give execution rights on the cron job
# RUN chmod 0644 /etc/cron.d/crontab

# Apply cron job
# RUN crontab /etc/cron.d/crontab

# Create the log file to be able to run tail
# RUN touch /var/log/cron.log

# RUN sed -i 's/^exec /service cron start\n\nexec /' /usr/local/bin/apache2-foreground

# Run Multiple command with bash script

# RUN chmod +x init_app.sh

# CMD ["init_app.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

