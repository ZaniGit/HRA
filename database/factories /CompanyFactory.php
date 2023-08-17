<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'document_cnpj' => $this->faker->text(255),
            'fantasy_name' => $this->faker->text(255),
            'zip_code' => $this->faker->text(255),
            'address' => $this->faker->address,
            'number' => $this->faker->text(255),
            'complement' => $this->faker->text(255),
            'city' => $this->faker->city,
            'state' => $this->faker->word(2),
            'district' => $this->faker->text(2),
            'telephone' => $this->faker->text(255),
            'cell_phone' => $this->faker->text(255),
        ];
    }
}
