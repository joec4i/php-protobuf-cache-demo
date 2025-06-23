FROM php:8.4-fpm-bookworm
RUN apt-get update && \
    apt-get install -y unzip git wget protobuf-compiler-grpc && \
    pecl install protobuf && docker-php-ext-enable protobuf

COPY conf.d/protobuf.ini /usr/local/etc/php/conf.d/protobuf.ini

WORKDIR /var/www/html
