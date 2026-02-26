FROM php:8.1-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libicu-dev \
        libonig-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        gd \
        zip \
        mbstring \
        intl \
        soap \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Ensure only prefork MPM is active (PHP requires it, event/worker conflict)
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides in document root
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Suppress the Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Apache to listen on port 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

# Copy application files
WORKDIR /var/www/html
COPY . .

# Ensure cache and uploads directories are writable
RUN mkdir -p cache uploads \
    && chown -R www-data:www-data cache uploads \
    && chmod -R 775 cache uploads

EXPOSE 8080

CMD ["apache2-foreground"]
