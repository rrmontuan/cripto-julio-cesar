FROM php:7.1-fpm

WORKDIR /var/www/html

COPY ./entrypoint.sh /etc/entrypoint.sh
RUN chmod +x /etc/entrypoint.sh

CMD ["php-fpm"]
ENTRYPOINT ["/etc/entrypoint.sh"]