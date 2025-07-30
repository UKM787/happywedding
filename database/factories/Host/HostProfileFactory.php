<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\HostProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HostProfile::class;

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
            'gender' => $this->faker->randomElement(['male', 'female']),
            'relation' => $this->faker->randomElement(['self']),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'mobile1' => $this->faker->phoneNumber(),
            'mobile2' => $this->faker->phoneNumber(),
            'whatsup' => $this->faker->phoneNumber(),
            'imageOne' => "/hosts/hostDefault.png",
            'slug'   => $slug,
            //'host_id' => Host::factory()->create()
        ];
    }
}
