<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\HostHome;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostHomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HostHome::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $complex_name = $this->faker->word();
        $slug = Str::slug($complex_name);

        return [
            'complexName' => $complex_name,
            'floor' => $this->faker->word(),
            'doorNo' => $this->faker->randomNumber(),
            'streetNo' => $this->faker->streetAddress(),
            'area' => $this->faker->word(),
            'district' => $this->faker->city(),
            'pin' => $this->faker->postcode(),
            'state' => $this->faker->state(),
            'zone' => $this->faker->word(),
            'country' => $this->faker->country(),
            'reachus' => $this->faker->url(),
            'slug'   =>  $slug,
            //'host_id' => Host::factory()->create()
        ];
    }
}
