<?php

namespace Database\Seeders;

use App\Models\Admin\Tag;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Admin\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = [
            [
                'created_at' => "May 8, 2020",
                'title' => $title = "How Happywed Simplified Our Wedding Invitations and Guest Management",
                'body' =>
                "We want to say thanks to happywed for their E-invitation wedding tool which we used for creating invitations for our wedding. Their wedding planning tool helped us to manage our guests stress-free, so happywed give us the perfect wedding we wanted.",
                'imageOne' => "testimonialDefault1.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "June 11, 2021",
                'title' => $title = "Managing Our Wedding Invitations with Happywed's Convenient E-Invitation Tool",
                'body' =>
                "As we had no time because of our busy schedules, we were worried about finding the time to plan our wedding. But happywed made it easy to keep track of important dates and handle the invitations process, which made planning stress-free. Thanks to happywed, we had an amazing wedding day that we'll always remember!",
                'imageOne' => "testimonialDefault2.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),

            ],
            [
                'created_at' => "July 11, 2021",
                'title' => $title = "Manage Our Wedding with Happywed's Planning Tools",
                'body' =>
                "We loved to use happywed to create great wedding invitations for our wedding. Their wedding planning tool had lots of options and helped us in managed our guests and more. Thanks to happywed, we managed everything on time and had a great wedding day!",
                'imageOne' => "testimonialDefault3.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "August 18, 2021",
                'title' => $title = "How Happywed's Guest Management Tool Made Our Wedding Planning a Breeze",
                'body' =>
                "My dream wedding planning experience was good with happywed. It helped us stay stress-free in the terms of handling invitations, guests, and their accommodations. So due to this tool, we could have a worry-free wedding day. Thanks to happywed.",
                'imageOne' => "testimonialDefault4.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "Sept 22, 2022",
                'title' => $title = "Effortlessly Managing RSVPs with Happywed's Planning Tool",
                'body' =>
                "Thanks to happywed where the RSVP management feature made it easy to keep track of who had responded to our invitation and who hadn't. This allowed us to follow up with guests who had not yet RSVP'd and finalize our guest list on time.",
                'imageOne' => "testimonialDefault5.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "Oct 25, 2022",
                'title' => $title = "Managing Our Wedding Guest List with Ease Thanks to Happywed",
                'body' =>
                "Finding the right wedding planning tool was one of the most important decisions we made while planning our wedding, and happywed is the best choice if you want someone who handles your invitations work and also takes care of your guests.Thanks to happywed.",
                'imageOne' => "testimonialDefault6.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "Nov 23, 2022",
                'title' => $title = "Managing RSVPs and Invitations with Happywed A Smooth Experience",
                'body' =>
                "The fact that happywed's e-invitation card and guest management tools were seamlessly integrated was a huge plus. It made it easy to manage everything in one place and saved us a lot of time and hassle.",
                'imageOne' => "testimonialDefault7.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "Jan 8, 2023",
                'title' => $title = "Our Stress-Free Wedding Planning Experience with Happywed",
                'body' =>
                "We highly recommend happywed's e-invitation card services and guest management tools for any couple planning their wedding. They were easy to use, saved us time and hassle, and made the entire process much smoother and less stressful.",
                'imageOne' => "testimonialDefault8.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
            [
                'created_at' => "Feb 9, 2023",
                'title' => $title = "Creating Personalized E-Invitations with Happywed's Wide Selection of Designs",
                'body' =>
                "happywed offers a wide range of beautiful e-invitation card designs to choose from, which allowed us to select a design that matched the theme of our wedding. This wedding tool was easy to navigate, and we were able to customize our e-invitations quickly and easily.",
                'imageOne' => "testimonialDefault9.png",
                'priority' => 1,
                'status' => 1,
                'slug' => Str::slug($title),
            ],
        ];

        // Admin::find(5)->testimonials()->create(Testimonial::factory(9)->make());
        // Admin::find(5)->testimonials()->saveMany(Testimonial::factory(30)->make());

        foreach ($testimonials as $key => $value) {
            Admin::find(5)->testimonials()->create($value);
        }
        Testimonial::all()->each(function ($testimonial) {
            $testimonial->tags()->attach(Tag::inRandomOrder()->take(rand(1, 5))->get());
        });
    }
}
