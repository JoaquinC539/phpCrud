FROM php:8.2-fpm-alpine3.19

RUN apk update

RUN apk add --no-cache nginx supervisor libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql

COPY ./nginxd.conf /etc/nginx/http.d/default.conf

COPY . /var/www/html

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord"]
