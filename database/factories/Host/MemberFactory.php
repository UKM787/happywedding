<?php

namespace Database\Factories\Host;

use App\Models\Host\Member;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

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
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->unique()->phoneNumber(),
            'department' => $this->faker->randomElement(['food', 'conveyance', 'accommodation', 'misc']),
            'role' => $this->faker->randomElement(['role1', 'role1', 'role3', 'role4', 'role5']),
            'imageOne' => $this->faker->imageUrl(),
            'slug' => $slug,
            //'invitation_id' => Invitation::factory()->create();
            //'remember_token' => Str::random(10),
        ];
    }
}
