FROM php:7.4.0-fpm-alpine AS production

ENV TIMEZONE="Europe/Berlin"
ENV COMPOSER_MEMORY_LIMIT=-1
ENV GRPC_VERBOSITY ERROR

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

RUN docker-php-ext-install --help

ENV BUILD_DEPS \
    autoconf \
    automake \
    gcc \
    g++ \
    libsodium-dev \
    libzip-dev \
    make \
    openssl-dev \
    zlib-dev

RUN apk add --no-cache \
    ${BUILD_DEPS} \
    openssl \
    unzip \
    libzip \
    git

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install -j"$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1)" pdo pdo_mysql opcache zip bcmath sodium sockets

RUN apk del ${BUILD_DEPS}

COPY docker/php/docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/zz-custom.ini
COPY docker/php/bin/xphp /bin/xphp
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /bin/xphp

COPY ./app /app

RUN mkdir -p /app/var/log /app/var/cache \
    && chmod 777 /app/var/log /app/var/cache

WORKDIR /app

# preload composer packages for dev and production
RUN composer install --no-scripts --no-interaction --no-progress


