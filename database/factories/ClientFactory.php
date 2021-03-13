<?php

namespace Database\Factories;

use App\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codeClient' => $this->faker->randomNumber,
            'raisonSociale' => $this->faker->name,
            'firstName' => $this->faker->firstName ,
            'lastName' => $this->faker->lastName ,
            'phone' => $this->faker->phoneNumber ,
            'mobile' => $this->faker->mobile ,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
