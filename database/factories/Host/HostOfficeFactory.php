<?php

namespace Database\Factories\Host;

use Illuminate\Support\Str;
use App\Models\Host\HostOffice;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostOfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HostOffice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company_name = $this->faker->company();
        $slug = Str::slug($company_name);
        return [
            'companyName' =>   $company_name,
            'complexName' => $this->faker->word(),
            'floor' => $this->faker->word(),
            'doorNo' => $this->faker->randomNumber(),
            'streetNo' => $this->faker->streetAddress(),
            'area' => $this->faker->word(),
            'district' => $this->faker->city(),
            'pin' => $this->faker->postcode(),
            'state' => $this->faker->state(),
            'zone' => $this->faker->word(),
            'country' => $this->faker->country(),
            'reachus' => $this->faker->url(),
            'slug'   => $slug,
            //'host_id' => Host::factory()->create()
        ];
    }
}
