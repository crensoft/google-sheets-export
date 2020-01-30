FROM php:apache

COPY . /var/www/html

CMD ["apache2-foreground"]