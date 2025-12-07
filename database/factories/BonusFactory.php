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
    protected $model = Bonus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['referral', 'profit_share']);
        $level = fake()->numberBetween(1, 5);

        return [
            'user_id' => User::factory(),
            'from_user_id' => User::factory(),
            'type' => $type,
            'amount' => fake()->randomFloat(2, 10, 500),
            'level' => $level,
            'description' => $type === 'referral' 
                ? "Level {$level} referral bonus" 
                : "Level {$level} profit share bonus",
        ];
    }

    /**
     * Indicate that this is a referral bonus.
     */
    public function referral(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'referral',
            'description' => "Level {$attributes['level']} referral bonus",
        ]);
    }

    /**
     * Indicate that this is a profit share bonus.
     */
    public function profitShare(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'profit_share',
            'description' => "Level {$attributes['level']} profit share bonus",
        ]);
    }
}
