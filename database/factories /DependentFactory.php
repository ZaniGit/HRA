<?php

namespace Database\Factories;

use App\Models\Dependent;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DependentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dependent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birth' => $this->faker->date,
            'document_cpf' => $this->faker->text(255),
            'kinship' => $this->faker->text(255),
            'dependent_ir' => $this->faker->word(255),
            'employe_id' => \App\Models\Employe::factory(),
        ];
    }
}
