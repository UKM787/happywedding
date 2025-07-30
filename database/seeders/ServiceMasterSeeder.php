<?php

namespace Database\Seeders;

use App\Models\Admin\ServiceMaster;
use Illuminate\Support\Str;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServiceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'name', 'description','status', 'parent_id', 'priority', 'icon', 'slug'
        $faker = \Faker\Factory::create();

        $vendors = [
            [
                'name' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'location_id' => 1001,
                'category_id' => 2,
                'role' => 'vendor',
                'slug'   => Str::slug('vendor'),
                'password' => Hash::make('123')
                // 'password' => bcrypt('123'),
            ],

        ];

        foreach ($vendors as $key => $value) {
            $vendor = Vendor::create($value);
        }

        Vendor::all()->each(function ($vendor) {
            $vendor->assignRole($vendor->slug);
        });

        $services =
            [
                ['name' => 'Invitation Card Design and E-invites', 'description' => 'Wedding Card Designs',  'status' => 0,  'priority' => 0, 'slug' => 'invitation-card-designs-and-e-invites', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Invitation-Cards.png", "icon" => "Invitation-Cards.svg"],
                ['name' => 'Guest Favors & Gifts', 'description' => 'Wedding Favors and Gifts Description',  'status' => 0,  'priority' => 0, 'slug' => 'guest-favors-and-gifts', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Favors-and-Gift.png", 'icon' => "Favors-and-Gift.svg"],
                ['name' => 'Wedding Stationery', 'description' => 'Wedding Stationery',  'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt',  'slug' => 'wedding-stationery', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Wedding-Stationery.png", "icon" => "Wedding-Stationery.svg"],


                ['name' => 'Groom Styles and Wears', 'description' => 'Wedding Groom Styles and Wear Description',  'status' => 0,  'priority' => 0, 'slug' => 'groom-styles-and-wears', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Groom-Styles-and-Wears.png", "icon" => "Groom-Styles-and-Wears.svg"],
                ['name' => 'Bridal Styles and Wears', 'description' => 'Wedding Bride Styles and Wear Description',  'status' => 0,  'priority' => 0, 'slug' => 'bridal-styles-and-wears', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bridal-Styles-and-Wears.png", 'icon' => "Bridal-Styles-and-Wears.svg"],
                ['name' => 'Groom Makeup Artists', 'description' => 'Wedding Makeup Artists Description',  'status' => 0,  'priority' => 0, 'slug' => 'groom-makeup-artists', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Groom-Makeup-Artists.png", 'icon' => "Groom-Makeup-Artists.svg"],
                ['name' => 'Bridal Makeup Artists', 'description' => 'Wedding Bridal Makeup Artists Description',  'status' => 0,  'priority' => 0, 'slug' => 'bridal-makeup-artists', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bridal-Makeup-Artists.png", 'icon' => "Bridal-Makeup-Artists.svg"],
                ['name' => 'Family Makeup Artists', 'description' => 'Wedding Family Makeup Artists Description',  'status' => 0,  'priority' => 0, 'slug' => 'family-makeup-artists', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Family-Makeup-Artists.png", 'icon' => "Family-Makeup-Artists.svg"],
                ['name' => 'Wedding Stylists and  Designers', 'description' => 'Wedding Stylists and Designer Description',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-stylists-and-designers', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Wedding-Stylists-and -Designers.png", "icon" => "Wedding-Stylists-and-Designers.svg"],
                ['name' => 'Clothing Rentals', 'description' => 'Wedding Clothing Rentals Description',  'status' => 0,  'priority' => 0, 'slug' => 'clothing-rentals', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Clothing-Rentals.png", "icon" => "Clothing-Rentals.svg"],
                ['name' => 'Bridal Mehendi Artists', 'description' => 'Wedding Bridal Mehendi Artists Description',  'status' => 0,  'priority' => 0, 'slug' => 'bridal-mehendi-artists', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bridal-Mehendi-Artists.png", 'icon' => "Bridal-Mehendi-Artists.svg"],
                ['name' => 'Wedding Decorations', 'description' => 'Wedding Decors Description',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-decorations', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Wedding-Decors.png", "icon" => "Wedding-Decors.svg"],
                ['name' => 'Flower Decorations', 'description' => 'Wedding Flow Decorators', 'status' => 0, 'parent_id' => null, 'admin_id' => 1, 'priority' => 0, 'slug' => 'flower-decorations',  'imageOne' => "Flower-Decorators.png", 'icon' => "Flower-Decorators.svg"],
                ['name' => 'Lighting Designing and Decorations', 'description' => 'Wedding Lighting Designers',  'status' => 0,  'priority' => 0, 'slug' => 'lighting-designing-and-decorations', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Lighting-designers.png", "icon" => "Lighting-designers.svg"],

                //foods and stalls - 5
                ['name' => 'Catering', 'description' => 'Caterers for Marriages', 'status' => 0, 'parent_id' => null, 'admin_id' => 1, 'priority' => 0, 'slug' => 'catering', 'imageOne' => "Catering.png", 'icon' => "Catering.svg"],
                ['name' => 'Cakes', 'description' => 'Wedding Cakes Description',  'status' => 0,  'priority' => 0, 'slug' => 'cakes', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Cakes.png", 'icon' => "Cakes.svg"],
                ['name' => 'Alcohol and Bartenders', 'description' => 'Wedding Bartenders Description',  'status' => 0,  'priority' => 0, 'slug' => 'alcohol-and-bartenders', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bartenders.png", 'icon' => 'Bartenders.svg'],
                ['name' => 'Home Catering', 'description' => 'Home Catering',  'status' => 0,  'priority' => 0, 'slug' => 'home-catering', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Home-Catering.png", 'icon' => "Home-Catering.svg"],
                ['name' => 'Chaat & Food Stalls', 'description' => 'Chaat and Food Stalls for Marriages',  'status' => 0,  'priority' => 0, 'slug' => 'chaat-and-food-stalls', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Chaat-and-Food-Stalls.png", "icon" => "Chaat-and-Food-Stalls.svg"],

                //Trousseau and Personnel Shopping - 6
                ['name' => 'Jewellery', 'description' => 'Jewellery Stores for Marriages', 'status' => 0, 'parent_id' => null, 'admin_id' => 1, 'priority' => 0, 'slug' => 'jewellery',  'imageOne' => "Jewellery-Stores.png", "icon" => "Jewellery-Stores.svg"],
                ['name' => 'Bridal Jewellery', 'description' => 'Wedding Bridal Jewellery',  'status' => 0,  'priority' => 0, 'slug' => 'bridal-jewellery', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bridal-Jewellery.png", 'icon' => "Bridal-Jewellery.svg"],
                ['name' => 'Bridal Jewellery On Rent', 'description' => 'Wedding Bridal Jewellery on Rent',  'status' => 0,  'priority' => 0, 'slug' => 'bridal-jewellery-on-rent', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bridal-Jewellery-On-Rent.png", 'icon' => "Bridal-Jewellery-On-Rent.svg"],

                //health and beauty - 7
                // ['name' => 'Health and Beauty', 'description' => 'Health and Beauty Centers for Marraiges', 'status' => 0, 'parent_id' => 8, 'admin_id' => 1, 'priority' => 0, 'slug' => 'health-and-beauty',  'imageOne' => "Health-and-Beauty.png", 'icon' => "Health-and-Beauty.svg"],

                //logistics - transport and accommodation - 8
                ['name' => 'Guest Accommodation', 'description' => 'Wedding Guests Acomodation',  'status' => 0,  'priority' => 0, 'slug' => 'guest-accommodation', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'Accommodation.png', 'icon' => 'Accommodation.svg'],
                ['name' => 'Transportation', 'description' => 'Transporters for Marriages for Vans, Buss and Luxury Vehicles', 'status' => 0, 'parent_id' => null, 'admin_id' => 1, 'priority' => 0, 'slug' => 'transportation', 'imageOne' => "Transportation.png", "icon" => "Transportation.svg"],
                ['name' => 'Car Rental Service', 'description' => 'Wedding Car Retnal Service',  'status' => 0,  'priority' => 0, 'slug' => 'car-rental-service', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Car-Rental-Service.png", 'icon' => "Car-Rental-Service.svg"],
                ['name' => 'Valvo Bus Rental Service', 'description' => 'Wedding Car Retnal Service',  'status' => true,  'priority' => 0, 'slug' => 'valvo-bus-rental-service',  'admin_id' => 1, 'parent_id' => 8, 'imageOne' => "Car-Rental-Service.png", 'icon' => "Car-Rental-Service.svg"],

                //music and entertainment - 9               
                ['name' => 'Choreography', 'description' => 'Wedding Choreography',  'status' => 0,  'priority' => 0, 'slug' => 'choreographers', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Choreographers.png", "icon" => "Choreographers.svg"],
                ['name' => 'Bandbaja', 'description' => 'Bandbaja wala for Weddings',  'status' => 0,  'priority' => 0, 'slug' => 'bandbaja', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Bandbaja.png", 'icon' => 'Bandbaja.svg'],
                ['name' => 'DJ/ Musicians/ Entertainment', 'description' => 'DJ, Musicians and Entertainment Artist Groups',  'status' => 0,  'priority' => 0, 'slug' => 'dj-musicians-entertainment', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "DJ-Musicians-Entertainment.png", "icon" => "DJ-Musicians-Entertainment.svg"],
                ['name' => 'Anchors', 'description' => 'Wedding Anchors',  'status' => 0,  'priority' => 0, 'slug' => 'anchors', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Anchors.png", 'icon' => 'Anchors.svg'],
                ['name' => 'Dance Groups', 'description' => 'Dance Groups and Artists for Entertainment',  'status' => 0,  'priority' => 0, 'slug' => 'dance-groups', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Anchors.png", 'icon' => 'Anchors.svg'],
                ['name' => 'Ghoriwala , Baggi & Palki wale', 'description' => 'Goriwala, Baggi & Palki Wale',  'status' => 0,  'priority' => 0, 'slug' => 'ghoriwala-baggi-and-palkiwale', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Ghoriwala.png", 'icon' => "Ghoriwala.svg"],

                //photography and cinematography  - 10
                ['name' => 'Wedding Photography', 'description' => 'Wedding Photographers',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-photographs', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Photographers.png", "icon" => "Photographers.svg"],
                ['name' => 'Prewed Photo Shoot', 'description' => 'Wedding Prewed Photographers',  'status' => 0,  'priority' => 0, 'slug' => 'prewed-photo-shoot', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Prewed-Photographers.png", "icon" => "Prewed-Photographers.svg"],
                ['name' => 'Prewed Videography', 'description' => 'Wedding Prewed Video Graphers',  'status' => 0,  'priority' => 0, 'slug' => 'prewed-videography', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "Prewed-Videographers.png", "icon" => "Prewed-Videographers.svg"],
                ['name' => 'Wedding VideoGraphy', 'description' => 'Wedding Video Graphers',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-videography', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "VideoGraphers.png", 'icon' => "VideoGraphers.svg"],
                // ['name' => 'Wedding VideoGraphy', 'description' => 'Wedding Video Graphers',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-videography', 'admin_id' => 1, 'parent_id' => null, 'imageOne' => "VideoGraphers.png", 'icon' => "VideoGraphers.svg"],

                //wedding priests - 11
                ['name' => 'Wedding Ritual Ceramonies', 'description' => 'Wedding Pandits and Priests',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-ritual-ceramonies', 'admin_id' => 1, 'parent_id' => 11, 'imageOne' => "Wedding-Priests.png", "icon" => "Wedding-Priests.svg"],

                //tours and travles - honeymoon -12               
                ['name' => 'Honeymoon Packages', 'description' => 'Honeymonn Packages',  'status' => 0,  'priority' => 0, 'slug' => 'honeymoon-packages', 'admin_id' => 1, 'parent_id' => 12, 'imageOne' => "Honeymoon-Packages.png", "icon" => "Honeymoon-Packages.svg"],

                // security and services -13
                ['name' => 'Security Guards', 'description' => 'Security Service Providers for Marraiges',  'status' => 0,  'priority' => 0, 'slug' => 'security-and-services', 'admin_id' => 1, 'parent_id' => 13, 'imageOne' => "Security-guards.png", "icon" => "Security-Services.svg"],
                ['name' => 'Ground and Drone Security Surveillance', 'description' => 'Security Service Providers for Marraiges',  'status' => 0,  'priority' => 0, 'slug' => 'ground-and-drone-security-surveillance', 'admin_id' => 1, 'parent_id' => 13, 'imageOne' => "Security-guards.png", "icon" => "Security-Services.svg"],
            ];

        foreach ($services as $key => $val) {
            ServiceMaster::create($val);
        }
    }
}
