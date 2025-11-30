<?php

namespace Database\Factories;

use App\Models\WtUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WtUser>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WtUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'nama_user' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'hp' => fake()->phoneNumber(),
            'acc_status' => 'active',
            'status_suspend' => 'active',
            'wd_status' => 'enabled',
        ];
    }
}
