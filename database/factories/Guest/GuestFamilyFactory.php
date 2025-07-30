<?php

namespace Database\Factories\Guest;

use Illuminate\Support\Str;
use App\Models\Guest\GuestFamily;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFamilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuestFamily::class;

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
            'name' =>  $name,
            'age' => $this->faker->randomDigit(),
            'gender' => $this->faker->randomElement(['male','female']),
            'relation' => $this->faker->randomElement(['son', 'wife', 'daughter', 'father', 'mother']),
            'mobile' =>  $this->faker->unique()->phoneNumber(),
            'imageOne' => $this->faker->imageUrl(),
            'imageTwo' => $this->faker->imageUrl(),
            'share' => 1,
            'slug' =>  $slug,
            //'guest_id' => User::factory()->create(),
        ];
    }
}
