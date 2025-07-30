<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'created_at' => "May 8, 2020",
            'title' => $title = $this->faker->unique()->text(50),
            'body' => $body = $this->faker->text(500),
            'imageOne' => "testi2.png",
            'priority' => 1,
            'published' => true,
            'imageOne' => 'defaultTestimonial.png',
            'slug' => Str::slug($title)

        ];
    }
}
