FROM php

RUN apt update && \
    apt upgrade && \
    apt install -y nano
    
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN php artisan key:generate && \
    php artisan migrate && \
    php artisan seed

WORKDIR /app