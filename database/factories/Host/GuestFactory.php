<?php

namespace Database\Factories\Host;

use App\Models\Host\Guest;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        $slug = Str::slug($name);
        return [
           'name' => $name,
           'mobile'=> $this->faker->phoneNumber(),
           'email' => $this->faker->unique()->safeEmail(),
           'active' => false,
           'inviteStatus' => 0,
           'slug'  => $slug
        ];
    }
}
