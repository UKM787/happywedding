<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Host\Invitation;
use App\Models\Host\CeramonyMaster;
use Illuminate\Database\Eloquent\Factories\Factory;

class CeramonyMasterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CeramonyMaster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->randomElement(['engagement', 'Mehendi', 'Sangeet', 'Haldi', 'Reception', 'Wedding', 'Tilak', 'Sugan', 'Roka']);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'type' => $this->faker->randomElement(['H', 'O']),
            'imageOne'  => $this->faker->imageUrl(),
            'slug'  => $slug,
            'host_id' => 1
        ];
    }
}
