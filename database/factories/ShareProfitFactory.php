<?php

namespace Database\Factories;

use App\Models\Investment;
use App\Models\ShareProfit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShareProfit>
 */
class ShareProfitFactory extends Factory
{
    protected $model = ShareProfit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $percentage = fake()->randomFloat(2, 0.5, 5);
        $amount = fake()->randomFloat(2, 10, 1000);

        return [
            'investment_id' => Investment::factory(),
            'amount' => $amount,
            'date' => fake()->dateTimeBetween('-30 days', 'now'),
            'percentage' => $percentage,
        ];
    }
}
