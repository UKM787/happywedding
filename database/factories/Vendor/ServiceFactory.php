<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\Service;

use App\Models\Vendor\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        $slug = $name;
        return [
            'name' =>$name,
            'category_id' => Category::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph,
            'price' => rand(1000, 99999),
            'slug'  => $slug
        ];
    }
}
