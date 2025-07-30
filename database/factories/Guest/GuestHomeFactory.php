<?php

namespace Database\Factories\Guest;

use Illuminate\Support\Str;
use App\Models\Guest\GuestHome;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestHomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuestHome::class;

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
            //'guest_id' => User::factory()->create()
        ];
    }
}
