FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Ambil Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory di dalam container
WORKDIR /var/www

# Copy semua file ke dalam container
COPY . .

# Beri izin akses folder storage dan cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]


# Salin script entrypoint
COPY entrypoint.sh /usr/local/bin/

# Beri izin eksekusi
RUN chmod +x /usr/local/bin/entrypoint.sh

# Jalankan script saat kontainer mulai
ENTRYPOINT ["entrypoint.sh"]