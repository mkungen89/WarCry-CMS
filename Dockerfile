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
RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf \
          /etc/apache2/mods-enabled/mpm_event.load \
          /etc/apache2/mods-enabled/mpm_worker.conf \
          /etc/apache2/mods-enabled/mpm_worker.load \
    && a2enmod mpm_prefork

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides in document root
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Suppress the Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy application files
WORKDIR /var/www/html
COPY . .

# Ensure cache and uploads directories are writable
RUN mkdir -p cache uploads \
    && chown -R www-data:www-data cache uploads \
    && chmod -R 775 cache uploads

EXPOSE 8080

# At runtime, bind Apache to $PORT (Railway injects it); fall back to 8080 locally.
CMD ["/bin/sh", "-c", \
  "PORT=${PORT:-8080} && \
   sed -i \"s/Listen 80$/Listen $PORT/\" /etc/apache2/ports.conf && \
   sed -i \"s/<VirtualHost \\*:80>/<VirtualHost *:$PORT>/\" /etc/apache2/sites-enabled/000-default.conf && \
   apache2-foreground"]
