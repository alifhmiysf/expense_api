# Security & Threat Modeling

## Authentication
Saya menggunakan **Laravel Sanctum** sebagai standar autentikasi berbasis token karena ringan dan aman untuk Stateful/Stateless API.

## Authorization (Access Control)
* **RBAC:** Implementasi Role-Based Access Control sederhana.
* **Policies:** Setiap resource (Transaction/Category) dilindungi oleh **Laravel Policy**. User hanya bisa mengakses data milik mereka sendiri (Isolasi Data).

## Audit Trail & Hardening
* **Activity Logs:** Mencatat setiap tindakan destruktif (create, update, delete) oleh user untuk keperluan audit.
* **Rate Limiting:** Mencegah serangan Brute Force pada endpoint autentikasi.
* **Mass Assignment Protection:** Menggunakan `$fillable` pada model untuk mencegah manipulasi kolom database secara ilegal.