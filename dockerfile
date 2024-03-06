FROM php:8.2-fpm

# Informar usuário para o wsl2
ARG user=falcao
ARG uid=1000

# Instala o Xdebug
RUN pecl install xdebug-3.2.1 \
	&& docker-php-ext-enable xdebug
COPY php/90-xdebug.ini "${PHP_INI_DIR}/conf.d"

# Instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configura a extensão GD para PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instala o Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criação de usuário para rodar Composer e Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

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

USER $user
