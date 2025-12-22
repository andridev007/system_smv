<?php

namespace Database\Factories;

use App\Models\Investment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 100, 10000);
        $licenseFee = $amount * 0.10; // 10% license fee
        $activeBalance = $amount - $licenseFee;

        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['daily', 'dream']),
            'amount' => $amount,
            'license_fee' => $licenseFee,
            'unique_code' => $this->faker->numberBetween(100, 999),
            'total_transfer' => $amount + $licenseFee,
            'status' => 'active',
            'proof_image' => null,
            'effective_date' => now(),
            'active_balance' => $activeBalance,
        ];
    }

    /**
     * Indicate that the investment is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'effective_date' => null,
        ]);
    }

    /**
     * Indicate that the investment is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'effective_date' => now(),
        ]);
    }

    /**
     * Indicate that the investment is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the investment is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'effective_date' => null,
        ]);
    }

    /**
     * Indicate that the investment is daily type.
     */
    public function daily(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'daily',
        ]);
    }

    /**
     * Indicate that the investment is dream type.
     */
    public function dream(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'dream',
        ]);
    }
}
