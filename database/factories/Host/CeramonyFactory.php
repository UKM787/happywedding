<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\Ceramony;
use Illuminate\Database\Eloquent\Factories\Factory;

class CeramonyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ceramony::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()   {

        $name = $this->faker->randomElement(['engagement', 'Mehendi', 'Sangeet', 'Haldi', 'Reception', 'Wedding', 'Tilak', 'Sugan', 'Roka']);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'type' => $this->faker->randomElement(['Hot', 'Others', 'special']),
            'imageOne'  => $this->faker->imageUrl(),
            'startDate' => $this->faker->date(now()),
            'startTime' => $this->faker->time(now()),
            'endDate' => $this->faker->date(now()),
            'endTime' => $this->faker->time(now()),
            'venue_id' => $this->faker->unique()->city(),
            'imageTwo' => $this->faker->imageUrl(),
            'imageThree' => $this->faker->imageUrl(),
            'slug' => $slug,
            //'invitation_id' => Invitation::factory()->create()

        ];
    }
}
