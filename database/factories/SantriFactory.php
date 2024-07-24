<?php

namespace Database\Factories;

use App\Models\Santri;
use App\Models\WaliSantri;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    protected $model = Santri::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('##################'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->dateTimeBetween(Carbon::create(2009, 1, 1), Carbon::create(2015, 12, 31))->format('Y-m-d'),
            'picture' => null,
            'address' => $this->faker->address(),
            'wali_santri_id' => $this->faker->randomElement(WaliSantri::query()->pluck('id')->toArray()),
        ];
    }
}
