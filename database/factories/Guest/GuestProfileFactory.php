<?php

namespace Database\Factories\Guest;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Guest\GuestProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuestProfile::class;

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
            'fatherName' => $this->faker->unique()->name(),
            'surname' => $this->faker->word(),
            'age' => $this->faker->randomNumber(),
            'gender' => $this->faker->randomElement(['male','female']),
            'relation' => $this->faker->randomElement(['self']),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'mobile1' => $this->faker->phoneNumber(),
            'mobile2' => $this->faker->phoneNumber(),
            'whatsup' => $this->faker->phoneNumber(),
            'imageOne' => "/guests/guestDefault.png",
            'slug'   => $slug,
            //'guest_id' => User::factory()->create()
        ];
    }
}
