FROM php:8.0-cli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /usr/src
WORKDIR /usr/src

RUN composer update
CMD [ "php", "./index.php" ]