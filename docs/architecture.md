# Software Architecture - Expense API

## High-Level Design
Proyek ini menggunakan arsitektur **Monolithic REST API** dengan Laravel 12. Saya memprioritaskan "Separation of Concerns" untuk memastikan setiap bagian kode mudah dirawat.

## Key Components
* **Service Layer:** Logika bisnis dipisahkan agar Controller tetap ramping.
* **Database Strategy:** Menggunakan MySQL dengan presisi **Decimal(15,2)** untuk data finansial dan **Soft Deletes** untuk integritas data.
* **Caching:** Memanfaatkan Laravel Cache untuk optimasi performa pada endpoint Dashboard.

## Environment
Aplikasi ini dikontainerisasi menggunakan **Docker**, memisahkan layanan PHP-FPM, Nginx, dan MySQL ke dalam container yang berbeda untuk konsistensi deployment.