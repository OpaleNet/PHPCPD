FROM alpine:edge
MAINTAINER Yann Mad <yann@opale.net>

WORKDIR /usr/src/app
COPY composer.json /usr/src/app/
COPY composer.lock /usr/src/app/

RUN apk --update add git php-common php-ctype php-iconv php-json php-dom php-pcntl php-phar php-openssl php-opcache php-sockets curl && \
    curl -sS https://getcomposer.org/installer | php && \
    /usr/src/app/composer.phar install && \
    apk del build-base && rm -fr /usr/share/ri

RUN adduser -u 9000 -D app

WORKDIR /code
COPY . /usr/src/app

USER app
VOLUME /code

CMD ["/usr/src/app/bin/codeclimate-phpcpd"]