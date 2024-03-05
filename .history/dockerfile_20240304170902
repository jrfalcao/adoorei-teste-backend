# Use a imagem oficial do PHP com Apache
FROM php:8.0-fpm

# Instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip

# Configura a extensão GD para PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instala o Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto para o container
COPY . /var/www

# Instala as dependências do projeto Laravel
RUN composer install

# Concede permissão para o Laravel poder escrever nos diretórios
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta 9000
EXPOSE 9000

# Inicia o PHP-FPM
CMD ["php-fpm"]
