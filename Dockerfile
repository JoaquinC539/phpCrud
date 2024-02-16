FROM php:8.2-fpm

RUN apt-get update

RUN apt-get install -y nginx

RUN apt-get install -y supervisor

RUN apt-get install -y libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql

COPY ./nginxd.conf /etc/nginx/conf.d/default.conf

COPY . /var/www/html

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord"]



