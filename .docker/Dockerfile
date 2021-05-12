FROM php:7.4-fpm-alpine

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apk update && apk add --no-cache openssl-dev curl git openssh mysql-client \
  freetype-dev libjpeg-turbo-dev libjpeg-turbo libpng-dev nodejs nodejs-npm

RUN  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install -j$(nproc) gd exif pdo_mysql && \
  curl -sS https://getcomposer.org/installer | php \
  && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

# Create system user to run Composer and Artisan Commands
RUN addgroup -g $uid $user && \
  adduser --ingroup www-data --ingroup root --ingroup $user --uid $uid --system --home /home/$user $user
RUN mkdir -p /home/$user/.composer && \
  chown -R $user:$user /home/$user

WORKDIR /var/www/html

USER $user
