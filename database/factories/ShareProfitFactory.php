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
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShareProfit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $percentage = $this->faker->randomFloat(2, 1, 20);
        $amount = $this->faker->randomFloat(2, 10, 1000);

        return [
            'investment_id' => Investment::factory(),
            'amount' => $amount,
            'date' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'percentage' => $percentage,
        ];
    }
}
