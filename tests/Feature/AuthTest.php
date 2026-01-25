<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
class AuthTest extends TestCase
{
    // Menggunakan database memory (bersih-bersih otomatis)
    use RefreshDatabase;

    /**
     * Skenario: User bisa register dengan sukses
     */
    public function test_user_can_register_successfully()
    {
        // 1. Data Pendaftaran
        $data = [
            'name' => 'Tester Robot',
            'email' => 'robot@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // 2. Robot menembak endpoint Register
        $response = $this->postJson('/api/register', $data);

        // 3. Verifikasi Hasil
        // a. Harusnya status 201 (Created)
        $response->assertStatus(201);

        // b. Harusnya database terisi data si robot
        $this->assertDatabaseHas('users', [
            'email' => 'robot@example.com',
        ]);
    }

    /**
     * Skenario 2: User bisa Login dan dapat Token
     */
    public function test_user_can_login_with_correct_credentials()
    {
        // 1. Kita buat user dulu di database (pakai Factory)
        $user = User::factory()->create([
            'email' => 'loginrobot@example.com',
            'password' => bcrypt('password123'), // Password di DB harus ter-encrypt
        ]);

        // 2. Robot mencoba Login via API
        $response = $this->postJson('/api/login', [
            'email' => 'loginrobot@example.com',
            'password' => 'password123', // Password input user (plain text)
        ]);

        // 3. Verifikasi
        $response->assertStatus(200); // Harusnya OK
        $response->assertJsonStructure([ // Harusnya dapat Token
            'token',
            'user'
        ]);
    }

    /**
     * Skenario 3: User bisa Logout
     */
    public function test_user_can_logout()
    {
        // 1. Buat user & pura-puranya dia sudah login (actingAs)
        $user = User::factory()->create();
        
        // Laravel Sanctum actingAs: Simulasi user punya token valid
        // Kita pakai library Sanctum untuk bypass login manual
        \Laravel\Sanctum\Sanctum::actingAs($user);

        // 2. Robot mencoba Logout
        $response = $this->postJson('/api/logout');

        // 3. Verifikasi
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Token revoked']);
    }


}