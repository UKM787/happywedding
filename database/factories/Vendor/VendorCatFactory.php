<?php

namespace Database\Factories\Vendor;

use Illuminate\Support\Str;
use App\Models\Vendor\VendorCat;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorCatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VendorCat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word(50);
        $slug = Str::slug($name);

        return [
            'name' => $this->faker->word(50),
            'description'  => $this->faker->word(100),
            'active'    => 1,
            'parent_id' => 0,
            'priority'  => 0,
            'icon'  => '',
            'slug' => $slug
        ];
    }
}

