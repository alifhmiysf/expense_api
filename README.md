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
- [x] **Create**: Endpoint `POST /api/transactions` (Auto User ID).
- [x] **Read**: Endpoint `GET /api/transactions` (Pagination + API Resource).
- [x] **Update**: Endpoint `PUT /api/transactions/{id}` (Cek Kepemilikan Data).
- [x] **Delete**: Endpoint `DELETE /api/transactions/{id}` (Soft/Hard Delete).
- [x] Filtering Lanjutan (Per bulan/kategori).
- [x] Management Category (CRUD Kategori).
- [x] Dashboard Summary.



### 4. Professional & Secure Backend 
- [x] **Secure File Upload**:
- [x] Fitur Update Profile (Nama & Email).
- [x] Upload Avatar dengan validasi ketat (MIME Type & Extension).
- [x] Symlink Storage untuk akses publik aman.
- [x] **Standardized Error Handling**: Format JSON error yang konsisten & tidak bocor info server.
- [x] **Rate Limiting**: Mencegah spam & brute force.
- [x] **Logging & Audit Trail**: Mencatat aktivitas mencurigakan.
- [x] **Change Password**: Fitur ganti password aman.
- [x] **Security Headers & Sanitization**: Anti XSS & HTTP Security.

### 4. Quality Assurance & Deployment 
- [x] **Testing Environment**: Konfigurasi PHPUnit & SQLite In-Memory.
- [x] **Automated Auth Test**: Testing Register, Login, & Logout otomatis.
- [x] **Feature Testing**: Testing CRUD Transaksi & Validasi Data.
- [x] **CI/CD Pipeline**: Automasi testing via GitHub Actions.
- [x] **Deployment**: Deploy aplikasi ke server production (Railway/VPS).
- [ ] **Service Repository Pattern**: Pemisahan logika bisnis dari Controller ke Service Layer untuk Clean Code.
- [ ] **API Documentation (Swagger/OpenAPI)**: Implementasi dokumentasi API otomatis yang bisa diakses via browser.
- [ ] **Database Optimization**:
    - [ ] Indexing pada kolom pencarian (user_id, date, category_id).
    - [ ] Analisis Query untuk memastikan performa tetap kencang di jutaan baris data.
 [ ] **Database Transaction & Locking**:
    [ ] Implementasi `DB::transaction()` untuk menjamin integritas data keuangan.
     [ ] Penggunaan Row Locking untuk mencegah Race Condition pada saldo.

### 5. DevOps & Containerization
- [x] Docker Foundation: Memahami Dockerfile & Docker Compose.

- [x] Service Orchestration: Konfigurasi docker-compose.yml untuk App & MySQL.

- [x] Environment Isolation: Menjamin konsistensi sistem di berbagai mesin (Lulus uji Windows ke Docker).

- [x] External Access: Implementasi Ngrok untuk akses publik tanpa kartu kredit.

- [x] Dynamic Configuration: Setup APP_URL dinamis mengikuti tunnel Ngrok.

- [x] Automation Script: [BONUS] Implementasi entrypoint.sh untuk auto-migrate & startup.

- [ ] Linux Mastery: Mastering Linux CLI & User Management (Target Hari 31).

- [ ] Production Setup: Setup VPS (Nginx, PHP-FPM, MySQL hardening).


