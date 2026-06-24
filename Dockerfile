FROM php:8.2-apache

# Habilitar el módulo rewrite de Apache (necesario para las rutas de Laravel)
RUN a2enmod rewrite

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd mbstring

# Configurar Apache para que apunte a la carpeta "public" de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar todos los archivos del proyecto al contenedor
COPY . .

# Crear el archivo .env a partir del ejemplo
RUN cp .env.example .env

# Instalar dependencias de Laravel para producción
RUN composer install --no-dev --optimize-autoloader

# Generar la clave de la aplicación (soluciona el Error 500 por APP_KEY faltante)
RUN php artisan key:generate

# Configurar permisos para que Laravel pueda escribir en storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80 (usado por Apache y Render por defecto)
EXPOSE 80
