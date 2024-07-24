<?php

namespace Database\Factories;

use App\Models\WaliSantri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaliSantri>
 */
class WaliSantriFactory extends Factory
{
    protected $model = WaliSantri::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->nik(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'education' => $this->faker->randomElement(['belum sekolah', 'sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor']),
            'job' => $this->faker->jobTitle(),
            'phone' => preg_replace('/\D/', '', $this->faker->phoneNumber()),
            'address' => $this->faker->address(),
        ];
    }
}
