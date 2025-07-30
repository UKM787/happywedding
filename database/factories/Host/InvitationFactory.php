<?php

namespace Database\Factories\Host;

use Carbon\Carbon;
use App\Models\Host\Host;
use Illuminate\Support\Str;
use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invitation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bridename = $this->faker->unique()->name();
        $groomname = $this->faker->unique()->name();
        $slug = Str::slug($bridename . '-' . $groomname);

        return [
            'brideName' => 'Sita',
            'brideFatherName' =>'Janak',
            'brideMotherName' => 'Janki',
            'brideEmail' =>'sita@gmail.com',
            'brideMobile' => '9999999999',
            'groomName' => 'Ram',
            'groomFatherName' => 'Dashrath',
            'groomMotherName' => 'Kaushalya',
            'groomEmail' => 'ram@gmail.com',
            'groomMobile' => '8888888888',
            'startDate' => Carbon::parse(now())->format('d.m.Y'),
            'endDate' => Carbon::parse(now())->format('d.m.Y'),
            'imageOne' =>  '/defaultsv1/invitationv0/cover1.png',
             'slug' =>'sita-weds-ram-by-host1',
            // 'host_id' => Host::factory()->create()
        ];
    }
}
