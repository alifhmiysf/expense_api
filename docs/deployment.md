# Deployment & CI/CD Flow

## Local Setup
Menggunakan script `entrypoint.sh` untuk otomatisasi:
1. `composer install`
2. `php artisan migrate --force`
3. `php artisan optimize`

## CI/CD Pipeline
Saya mengimplementasikan **GitHub Actions** yang berjalan secara otomatis pada setiap `push` ke branch `main` atau `develop`.
* **Job 1 (Static Analysis):** Cek sintaks PHP.
* **Job 2 (Automated Testing):** Menjalankan **PHPUnit** untuk memastikan 100% fungsionalitas utama (Auth & Transaction) lulus sensor.