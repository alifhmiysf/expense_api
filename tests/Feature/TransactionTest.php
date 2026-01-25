<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Skenario 1: User bisa membuat transaksi baru
     */
    public function test_user_can_create_transaction()
    {
        // 1. Siapkan User & Kategori
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id]); 

        // 2. Login
        Sanctum::actingAs($user);

        // 3. Data Kiriman
        $data = [
            'amount' => 50000,
            'category_id' => $category->id,
            'description' => 'Beli Nasi Padang',
            'transaction_date' => '2026-01-25',
        ];

        // 4. Tembak API
        $response = $this->postJson('/api/transactions', $data);

        // 5. Verifikasi Sukses (REVISI DISINI)
        $response->assertStatus(201);
        
        // Kita tidak cek 'message', tapi cek apakah DATA yang balik sesuai inputan
        // API Resource membungkus response dalam key "data"
        $response->assertJsonPath('data.amount', 50000); 
        $response->assertJsonPath('data.description', 'Beli Nasi Padang');
        
        // 6. Cek Database
        $this->assertDatabaseHas('transactions', [
             'amount' => 50000,
             'description' => 'Beli Nasi Padang',
             'user_id' => $user->id,
        ]);
    }

    /**
     * Skenario 2: User bisa melihat daftar transaksinya sendiri
     */
    public function test_user_can_view_own_transactions()
    {
        // 1. Siapkan User
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // 2. Buat Data Dummy
        $category = Category::factory()->create(['user_id' => $user->id]);
        
        \App\Models\Transaction::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'amount' => 100000,
            'transaction_date' => '2026-01-01' // Pastikan tanggal terisi
        ]);

        // 3. Tembak API
        $response = $this->getJson('/api/transactions');

        // 4. Verifikasi (REVISI DISINI)
        $response->assertStatus(200);
        
        // Masalah "null given" tadi karena kita minta 'data.data' (2 lapis).
        // API Resource Collection biasanya cuma 1 lapis 'data'.
        $response->assertJsonCount(1, 'data'); 
        
        // Cek apakah angka 100000 ada di dalam response
        $response->assertJsonFragment(['amount' => 100000]); 
    }
}