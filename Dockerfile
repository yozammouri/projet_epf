FROM php:8.4-fpm
RUN apt update -yq && \
    apt install -yq curl nano vim nginx git wget
RUN curl -sSl https://getcomposer.org/download/2.8.5/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

## Install Symfony binary
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

## Docker php ext installer
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o /usr/local/bin/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions

## Install php ext : Better install with https://github.com/mlocati/docker-php-extension-installer
RUN install-php-extensions  opcache-stable \
                            redis-stable \
                            intl-stable \
                            zip-stable \
                            pdo_pgsql-stable \
                            pdo_mysql-stable && \
    IPE_DONT_ENABLE=1 \
    install-php-extensions  xdebug-stable && \
    install-php-extensions  @composer

COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY docker/nginx.conf /etc/nginx/sites-enabled/default
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT docker-entrypoint.sh