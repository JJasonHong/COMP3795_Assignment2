<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Using 'username' to store the email address
            'username' => fake()->unique()->safeEmail(),
            // First name
            'firstName' => fake()->firstName(),
            // Last name
            'lastName' => fake()->lastName(),
            // Hashed password (default: 'password')
            'password' => static::$password ??= Hash::make('password'),
            // Registration date set to now
            'registrationDate' => now(),
            // Default approval status is false
            'isApproved' => false,
            // Default role is 'Contributor'
            'role' => 'Contributor',
        ];
    }
}
