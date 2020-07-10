FROM demidovich/php-fpm:7.3-alpine

ARG UID=82
ARG GID=82
ENV UID=${UID:-82} \
    GID=${GID:-82}

ENV UID=1000 \
    GID=1000

RUN set -eux \
    && if [ $UID -ne 82 ]; then \
        usermod -u $UID www-data; \
    fi \
    && if [ $GID -ne 82 ]; then \
        groupmod -g $GID www-data; \
    fi \
    && mkdir -p /var/lib/php7/sessions \
    && mkdir /app \
    && chown \
        --changes \
        --silent \
        --no-dereference \
        --recursive \
        ${UID}:${GID} \
        /app \
        /composer \
        /var/log/php7 \
        /var/lib/php7/sessions

USER $UID
WORKDIR /app

