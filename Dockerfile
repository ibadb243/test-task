FROM php:8.2-apache

# 1. Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 2. Расширения PHP
RUN docker-php-ext-install pdo_mysql mbstring

# 3. Включаем rewrite
RUN a2enmod rewrite

# 4. Явно настраиваем виртуальный хост Apache на папку /public
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# 5. Убираем ошибку ServerName из логов
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 6. Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html