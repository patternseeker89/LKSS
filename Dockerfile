FROM php:8.0-cli

RUN apt-get update
RUN apt-get install -y vim nano

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

COPY . /usr/src
WORKDIR /usr/src

RUN composer install

#CMD [ "php", "./lkss.php" ]
CMD bash -c "composer install"
