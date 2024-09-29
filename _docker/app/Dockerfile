FROM php:8.2-fpm

ARG UID
ARG USER
ARG APP_MOUNTING_AREA
ENV UID=${UID:-1000} \ 
    USER=${USER:-sammy} \
    APP_MOUNTING_AREA=${APP_MOUNTING_AREA:-/var/www/test-task-ji-touch/app}

RUN apt-get update && apt-get install -y \
    git \
    curl \
    nano \
    bash \
    libpng-dev \
    libonig-dev \
    libwebp-dev \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip 
    
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update

WORKDIR ${APP_MOUNTING_AREA}

RUN chown -R www-data:www-data ${APP_MOUNTING_AREA}

RUN useradd -G www-data,root -u ${UID} -d /home/${USER} ${USER}
RUN mkdir -p /home/${USER}/.composer && \
    chown -R ${UID}:${UID} /home/${USER}
USER ${USER}
