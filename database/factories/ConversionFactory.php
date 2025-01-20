<?php

namespace Database\Factories;

use App\Enums\ConversionSupported;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'original' => fake()->numberBetween(1, 1000),
            'value' => fake()->numberBetween(1, 1000),
            'conversion_driver' => fake()->randomElement([ConversionSupported::RomanNumeral, ConversionSupported::GramToKg, ConversionSupported::KgToGram]),
        ];
    }
}
