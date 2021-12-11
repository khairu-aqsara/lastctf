FROM php:7.4.26-fpm-alpine3.13
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php
RUN mkdir chal
WORKDIR /chal
COPY src /chal
RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev
RUN composer install --prefer-dist
RUN apk add --no-cache socat
EXPOSE 9002
CMD ["socat", "TCP-LISTEN:9002,fork,reuseaddr", "EXEC:\"php application breakme\",pty,stderr"] 