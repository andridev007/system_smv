<?php

namespace Database\Factories;

use App\Models\Bonus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bonus>
 */
class BonusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bonus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'from_user_id' => User::factory(),
            'type' => $this->faker->randomElement(['referral', 'profit_share']),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'level' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->sentence(),
        ];
    }

    /**
     * Indicate that the bonus is a referral bonus.
     */
    public function referral(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'referral',
            'description' => 'Referral bonus',
        ]);
    }

    /**
     * Indicate that the bonus is a profit share bonus.
     */
    public function profitShare(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'profit_share',
            'description' => 'Profit share bonus',
        ]);
    }
}
