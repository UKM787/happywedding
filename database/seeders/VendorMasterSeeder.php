<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use App\Models\Admin\CategoryMaster;
use Illuminate\Support\Facades\Hash;

class VendorMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create main vendor category first
        $vendorCategory = CategoryMaster::firstOrCreate(
            ['name' => 'Wedding Venues'],
            [
                'description' => 'Wedding Venues',
                'status' => true,
                'priority' => 0,
                'slug' => 'wedding-venues',
                'relation' => 'venues',
                'path' => 'venues',
                'admin_id' => 1,
                'parent_id' => null,
                'icon' => "Venues.svg",
                'imageOne' => "Venues.png",
            ]
        );

        // Create venue subcategories
        $venueSubcategories = [
            [
                'name' => 'Resorts',
                'description' => 'Resorts Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'resorts-weddings'
            ],
            [
                'name' => 'Destinations',
                'description' => 'Destination Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5414.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'destination-weddings'
            ],
            [
                'name' => 'Beach & Island',
                'description' => 'Beach & Island Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5416.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'beach-island-weddings'
            ],
            [
                'name' => 'Hotels',
                'description' => 'Hotel Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5417.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'hotel-weddings'
            ],
            [
                'name' => 'Lawns & Farmhouses',
                'description' => 'Lawns and Farmhouse Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'lawns-farmhouse-weddings'
            ],
            [
                'name' => 'Palaces & Forts',
                'description' => 'Palace & Forts Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'palace-forts-weddings'
            ],
            [
                'name' => 'Amusement Parks',
                'description' => 'Amusement Parks Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'amusements-parks-weddings'
            ],
            [
                'name' => 'Cruise & Boats',
                'description' => 'Cruise Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'cruise-boats-weddings'
            ],
            [
                'name' => 'Place of Worships',
                'description' => 'Place of Worship Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'place-of-worhip-weddings'
            ],
            [
                'name' => 'Garden Weddings',
                'description' => 'Garden Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'garden-weddings'
            ],
            [
                'name' => 'Banquent Halls',
                'description' => 'Banquent Halls Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'banquent-hall-weddings'
            ],
            [
                'name' => 'Community Centers',
                'description' => 'Community Center Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'community-center-weddings'
            ],
            [
                'name' => 'Kalyan Mandapam',
                'description' => 'Kalyan Mandapam Weddings',
                'status' => true,
                'parent_id' => $vendorCategory->id,
                'imageOne' => '/assets/venues/Frame5413.png',
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'kalyan-mandapam-weddings'
            ]
        ];

        foreach ($venueSubcategories as $subcategory) {
            CategoryMaster::firstOrCreate(
                ['name' => $subcategory['name']],
                $subcategory
            );
        }

        // Create other vendor categories
        $otherCategories = [
            [
                'name' => 'Wedding Planners',
                'description' => 'Planning of Marriage Activites and Tasks',
                'status' => true,
                'parent_id' => null,
                'admin_id' => 1,
                'priority' => 0,
                'slug' => 'wedding-planners',
                'icon' => 'Wedding-Planners.svg',
                'imageOne' => "Wedding-Planners.png"
            ],
            [
                'name' => 'Accommodation',
                'description' => 'Wedding Guests Acomodation Providers',
                'status' => true,
                'priority' => 0,
                'slug' => 'accommodation',
                'relation' => 'accommodations',
                'path' => 'accommodation',
                'admin_id' => 1,
                'parent_id' => null,
                'imageOne' => 'Accommodation.png',
                'icon' => 'Accommodation.svg'
            ],
            // ... Add other categories as needed
        ];

        foreach ($otherCategories as $category) {
            CategoryMaster::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
