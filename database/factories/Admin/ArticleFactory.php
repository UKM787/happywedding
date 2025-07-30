<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = $this->faker->unique()->word(50),
            'body'  => $body = $this->faker->text(500),
            'priority' => 1,
            'published' => true,
            'imageOne' => 'defaultArticle.png',
            'slug' => Str::slug($title)
        ];
    }
}
