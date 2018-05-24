FROM php:5-apache

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

CMD apache2-foreground
