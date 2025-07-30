<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Story::class;

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
            'intro' => $name,
            'imageOne'   => $this->faker->imageUrl(),
            'imageTwo'=> $this->faker->imageUrl(),
            'imageThree'=> $this->faker->imageUrl(),
            'firstMeet' => $this->faker->year(),
            'firstMeetDescription' => $this->faker->sentences($nb = 1, $asText = true),
            'imageFour' => $this->faker->imageUrl(),
            'secondMeet' => $this->faker->year(),
            'secondMeetDescription' => $this->faker->sentences($nb = 2, $asText = true),
            'imageFive' => $this->faker->imageUrl() ,
            'thirdMeet' => $this->faker->year(),
            'thirdMeetDescription' => $this->faker->sentences($nb = 3, $asText = true),
            'imageSix' => $this->faker->imageUrl(),
            'counter'=> false,
            'slug' => $slug,
            // 'invitation_id'=> Invitation::factory()->make()
        ];
    }
}

