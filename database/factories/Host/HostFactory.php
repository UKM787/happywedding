<?php

namespace Database\Factories\Host;

use App\Models\Host\Host;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Host::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->unique()->phoneNumber(),
            'city'  => $this->faker->city(),
            'active'    => 1,
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'password' => bcrypt('123'), // password
            'slug' => $slug
            //'remember_token' => Str::random(10),
        ];
    }
}
