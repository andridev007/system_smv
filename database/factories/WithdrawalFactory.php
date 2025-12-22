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
    protected $model = Withdrawal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 50, 5000);
        $fee = $amount * 0.1; // 10% fee
        $finalAmount = $amount - $fee;

        return [
            'user_id' => User::factory(),
            'amount' => $amount,
            'fee' => $fee,
            'final_amount' => $finalAmount,
            'source' => fake()->randomElement(['investment', 'share_profit', 'bonus']),
            'bank_details_snapshot' => json_encode([
                'bank_name' => fake()->company(),
                'account_number' => fake()->bankAccountNumber(),
                'account_holder' => fake()->name(),
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

    /**
     * Indicate that the withdrawal is from share profit.
     */
    public function fromShareProfit(): static
    {
        return $this->state(fn (array $attributes) => [
            'source' => 'share_profit',
        ]);
    }

    /**
     * Indicate that the withdrawal is from bonus.
     */
    public function fromBonus(): static
    {
        return $this->state(fn (array $attributes) => [
            'source' => 'bonus',
        ]);
    }

    /**
     * Indicate that the withdrawal is from investment.
     */
    public function fromInvestment(): static
    {
        return $this->state(fn (array $attributes) => [
            'source' => 'investment',
        ]);
    }
}
