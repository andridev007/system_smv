<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Withdrawal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 50, 5000);
        $fee = $amount * 0.05; // 5% fee
        $finalAmount = $amount - $fee;

        return [
            'user_id' => User::factory(),
            'amount' => $amount,
            'fee' => $fee,
            'final_amount' => $finalAmount,
            'source' => $this->faker->randomElement(['investment', 'share_profit', 'bonus']),
            'bank_details_snapshot' => json_encode([
                'bank_name' => $this->faker->company(),
                'account_number' => $this->faker->bankAccountNumber(),
                'account_holder' => $this->faker->name(),
            ]),
            'status' => 'pending',
            'proof_image' => null,
        ];
    }

    /**
     * Indicate that the withdrawal is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the withdrawal is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    /**
     * Indicate that the withdrawal is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }
}
