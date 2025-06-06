FROM php:8.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./php.ini /usr/local/etc/php/

RUN a2enmod rewrite

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/allow-override.conf && \
    a2enconf allow-override

WORKDIR /var/www/html/public