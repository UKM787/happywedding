<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\Savedate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavedateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Savedate::class;

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
            'startDate' => $this->faker->date(now()),
            'startTime' => $this->faker->time(now()),
            'countdown'=> $this->faker->time(),
            'counter' => false,
            'imageOne' => $this->faker->imageUrl(),
            'slug'  => $slug
             // 'invitation_id'=> Invitation::factory()->make()
        ];
    }
}
