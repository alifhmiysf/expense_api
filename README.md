# Expense API Project

Repo ini untuk belajar Backend Laravel + Security Basic (Roadmap 90 Hari).

## Progress

### 1. Database Design
- [x] Membuat Migration `categories` (dengan Soft Deletes).
- [x] Membuat Migration `transactions` (dengan Relasi Foreign Key & Decimal).
- [x] Memahami kenapa Float dilarang untuk uang (Pakai Decimal).
- [x] Implementasi Model & Relationship (One to Many).

### 2. Authentication (Sanctum)
- [x] Setup Laravel Sanctum.
- [x] Register Endpoint (Output Token).
- [x] Login Endpoint (Output Token).
- [x] Logout Endpoint (Revoke Token).
- [x] Protect Route Middleware (`auth:sanctum`).



### 3. Core Transaction Logic (Minggu 2)
- [x] **Validasi Input**: Implementasi `StoreTransactionRequest` untuk mencegah data sampah.
- [x] **Create Transaction**: Endpoint `POST /api/transactions` sukses menyimpan data.
- [x] **Relasi Otomatis**: Transaksi otomatis tersambung ke User yang sedang login.
- [x] API Resource (Format JSON Cantik).
- [x] Pagination & Filtering.
- [ ] Update & Delete Transaction.