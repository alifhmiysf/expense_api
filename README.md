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