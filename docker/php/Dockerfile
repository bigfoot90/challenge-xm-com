FROM php:7.4-fpm-alpine

ARG USERID=1000

ENV PATH=./bin:./vendor/bin:./node_modules/.bin:$PATH

# Install utils and dev-libs
RUN apk add --update coreutils curl git icu-dev nano

# Install php modules
RUN docker-php-ext-install -j$(nproc) \
        intl \
        opcache \
        pdo_mysql && \
    docker-php-source delete

#RUN MODULES="apcu xdebug"; \
#    for MODULE in ${MODULES}; do \
#        echo "DOWNLOADING https://pecl.php.net/get/$MODULE"; \
#        mkdir -p "/usr/src/php/ext/$MODULE"; \
#        curl -fsSL "https://pecl.php.net/get/$MODULE" | tar xvz -C "/usr/src/php/ext/$MODULE"; \
#        docker-php-ext-install $MODULE; \
#    done && \
#    docker-php-source delete
RUN mkdir -p /usr/src/php/ext/apcu && curl -fsSL https://pecl.php.net/get/apcu | tar xvz -C "/usr/src/php/ext/apcu" --strip 1 && docker-php-ext-install -j$(nproc) apcu
RUN mkdir -p /usr/src/php/ext/xdebug && curl -fsSL https://pecl.php.net/get/xdebug | tar xvz -C "/usr/src/php/ext/xdebug" --strip 1 && docker-php-ext-install -j$(nproc) xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=2.0.0-RC1

# Install NodeJS and Yarn
RUN apk add nodejs yarn

# Setup user www-data
RUN if [ ${USERID} -ne 82 ]; then \
        apk add --update shadow; \
        usermod -u ${USERID} www-data; \
        apk del shadow; \
    fi

USER $USERID
WORKDIR /srv
CMD php-fpm --nodaemonize
EXPOSE 8000