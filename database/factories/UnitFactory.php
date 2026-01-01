<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'abbreviation' => strtoupper($this->faker->unique()->bothify('??')),
            'format' => $this->faker->randomElement([1, 2]),
            'user_id_created' => 1,
            'owner_id' => 1,
        ];
    }

    public function withName(string $name): self
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    public function withFormat(int $format): self
    {
        return $this->state(fn (array $attributes) => [
            'format' => $format,
        ]);
    }
}
