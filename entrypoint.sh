#!/bin/sh

# Tunggu sampai database siap (opsional tapi bagus untuk stabilitas)
echo "Menunggu koneksi database..."

# Install dependency jika belum ada
composer install --no-interaction --prefer-dist --optimize-autoloader

# Jalankan migrasi secara otomatis
php artisan migrate --force

# Pastikan folder storage bisa ditulisi
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Jalankan server Laravel
echo "Aplikasi siap di udara!"
php artisan serve --host=0.0.0.0 --port=8000