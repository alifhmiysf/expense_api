<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'amount' => $this->faker->numberBetween(10000, 1000000),
            
            'description' => $this->faker->sentence,
            'transaction_date' => $this->faker->date(),
        ];
    }
}