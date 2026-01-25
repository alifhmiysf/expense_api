<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Kalau user_id tidak diisi manual, dia akan bikin User baru otomatis
            'user_id' => \App\Models\User::factory(), 
            'name' => $this->faker->word, // Nama kategori acak (contoh: "aut", "eum"),
            'type' => $this->faker->randomElement(['income', 'expense']),
            

        ];
    }
}