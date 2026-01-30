# Expense API Project

Repo ini untuk belajar Backend Laravel + Security Basic (Roadmap 90 Hari).

## Progress

### 1. Database Design & Foundation 
- [x] Membuat Migration `categories` (dengan Soft Deletes).
- [x] Membuat Migration `transactions` (dengan Relasi Foreign Key & Decimal).
- [x] Memahami kenapa Float dilarang untuk uang (Pakai Decimal).
- [x] Implementasi Model & Relationship (One to Many).

### 2. Authentication / Security 
- [x] Setup Laravel Sanctum.
- [x] Register Endpoint (Output Token).
- [x] Login Endpoint (Output Token).
- [x] Logout Endpoint (Revoke Token).
- [x] Protect Route Middleware (`auth:sanctum`).

### 3. Core Transaction Logic 
- [x] **Validasi Input**: Implementasi `StoreTransactionRequest` & `UpdateTransactionRequest`.
- [x] **Create**: Endpoint `POST /api/transactions` (Auto User ID & Activity Log).
- [x] **Read**: Endpoint `GET /api/transactions` (Pagination + API Resource).
- [x] **Update**: Endpoint `PUT /api/transactions/{id}` (Cek Kepemilikan Data via Policy).
- [x] **Delete**: Endpoint `DELETE /api/transactions/{id}` (Soft Delete aktif).
- [x] **Restore**: Fitur mengembalikan data dari tong sampah (`POST /api/transactions/{id}/restore`).
- [x] Filtering Lanjutan (Per bulan/kategori).
- [x] Management Category (CRUD Kategori).
- [x] **Advanced Dashboard**: Summary Balance & Insight Top 3 Pengeluaran Terbesar.

### 4. Professional & Secure Backend 
- [x] **Secure File Upload**: Fitur Update Profile & Avatar (MIME Type Validation).
- [x] **Authorization (Policy)**: Proteksi data antar user (Security Hardening).
- [x] **Standardized Error Handling**: Format JSON error konsisten & APP_DEBUG management.
- [x] **Rate Limiting**: Implementasi Throttle (60 req/min) untuk mencegah brute force.
- [x] **Logging & Audit Trail**: ActivityLog untuk setiap aksi (Register, Login, Create, Delete, Restore).
- [x] **Change Password**: Fitur ganti password aman.
- [x] **Security Headers & Sanitization**: Proteksi dasar API terhadap XSS/Injection.

### 5. Quality Assurance & Deployment 
- [x] **Testing Environment**: Konfigurasi PHPUnit & SQLite In-Memory.
- [x] **Automated Auth Test**: Testing Register, Login, & Logout otomatis.
- [x] **Feature Testing**: Testing CRUD Transaksi & Validasi Data.
- [x] **CI/CD Pipeline**: Automasi testing via GitHub Actions.
- [x] **Deployment**: Deploy aplikasi ke server production (VPS Simulasi).
- [x] **Clean Code Preparation**: Penggunaan API Resources & Form Requests.

### 6. DevOps & Containerization
- [x] **Linux Mastery**: CLI, Permissions, & Directory Structure `/var/www/`.
- [x] **Production Setup**: Konfigurasi PHP 8.3 & MySQL 8.0 di Ubuntu.
- [x] **Dockerization**:
    - [x] `Dockerfile` & `docker-compose.yml` (Isolasi App & DB).
    - [x] Optimasi Docker (Hapus version obsolete & Cache Optimization).
- [x] **Advanced Networking**:
    - [x] Reverse SSH Tunneling untuk bypass NAT.
    - [x] Setup Ngrok untuk akses publik dinamis (Auto-update URL).

### 7. Final Status: COMPLETE 
- [x] Semua fitur utama Backend & Security sesuai Roadmap 90 Hari telah diimplementasikan.
- [x] Sistem siap untuk dikembangkan ke tahap Frontend atau Mobile App.