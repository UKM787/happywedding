<?php

namespace Database\Factories\Guest;

use Illuminate\Support\Str;
use App\Models\Guest\GuestDeparture;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestDepartureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuestDeparture::class;

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
            'departureDate' =>  $this->faker->date(),
            'departureTime' => $this->faker->time(),
            'location' => $this->faker->randomElement(['Airport', 'Railway Station', 'Bus Stand']),
            'modeOfTravel' => $this->faker->randomElement(['By Air', 'By Train', 'By Valvo']),
            'noOfMembers' => 6,
            'vehicleNo' =>  $this->faker->regexify('[A-Za-z0-9]{9}'),
            'driverName' => $this->faker->name(),
            'driverMobile' => $this->faker->phoneNumber(),
            'inchargeName' => $this->faker->name(),
            'inchargeMobile' => $this->faker->phoneNumber(),
            'inchargelocation' => $this->faker->randomElement(['Airport', 'Railway Station', 'Bus Stand']),
            'slug' =>  $slug,
            //'guestinvitation_id' => User::factory()->create(),
        ];
    }
}
