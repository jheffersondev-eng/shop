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

EXPOSE 80
EXPOSE 80
