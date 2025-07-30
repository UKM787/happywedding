<?php

namespace Database\Factories\Admin;

use App\Models\Vendor\Service\Venue;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

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
            'nameOfPlace' => $this->faker->randomElement(['Chennai Hotel', 'Hyatt Hotel','The Taj','The Marriot']),
            'nameOfHall' => $this->faker->randomElement(['Rasoi', 'Punjabi Kitchen', 'InterContinental', 'Bar','Marriage Hall']),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'pincode' => $this->faker->postcode(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'reachHere' => $this->faker->url(),
            'imageOne'  => $this->faker->imageUrl,
            'slug' => $slug
            //'host_id' => Host::factory()->make();
        ];
    }
}
