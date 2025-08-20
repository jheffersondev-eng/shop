# Dockerfile para PHP (versão mais recente estável)
FROM php:8.3-apache

# Instala extensões comuns do PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Altera o DocumentRoot para a nova pasta de views
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/html/resources/views/home|g" /etc/apache2/sites-available/000-default.conf
RUN sed -i "s|<Directory /var/www/html>|<Directory /var/www/html/resources/views/home>|g" /etc/apache2/apache2.conf

EXPOSE 80
EXPOSE 80
