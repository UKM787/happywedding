<?php

namespace Database\Seeders;

use App\Models\Admin\CategoryMaster;
use Illuminate\Database\Seeder;


class CategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories =  [

            // Event Management - 1
            ['name' => 'Event Management', 'description' => 'Planning of Marriage Activites and Tasks for making the wedding an unforgetable event for you for entire life', 'status' => 0, 
            'path' => '', 'parent_id' => null, 'admin_id' => 1, 'priority' => 0, 'slug' => 'event-management', 'icon' => 'event-management.svg', 'imageOne' => "event-management.png"],

            //wedding venues - 2
            ['name' => 'Wedding Venues', 'description' => 'Wedding Venues',  'status' => true,  'priority' => 0, 'slug' => 'wedding-venues', 'relation' => 'venues', 'path' => 'venues',   'admin_id' => 1, 'parent_id' => null, 'icon' => "wedding-venues.svg", 'imageOne' => "wedding-venues.png"],

            //invitation and guest favours - 3
            ['name' => 'Invitation and Guest Favors', 'description' => 'from creating of invitation to e-invites and delivering to guest aling with choice of best gifts for guest - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'invitation-and-guest-favors', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'invitation-and-guest-favors.png', 'icon' => 'invitation-and-guest-favors.svg'],

            //wedding theme creators - 4
            ['name' => 'Wedding Theme Creators', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-theme-creators', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'wedding-theme-creators.png', 'icon' => 'wedding-theme-creators.svg'],

            //Wedding Wear Styles and Makeups - 5
            ['name' => 'Wedding Wear Styles and Makeups', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-wear-styles-and-makeups', 'relation' => '', 'path' => 'wear-style-makeup',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'wedding-wear-styles-and-makeups.png', 'icon' => 'wedding-wear-styles-and-makeups.svg'],

            //foods and stalls - 6
            ['name' => 'Catering and Food Stalls', 'description' => 'Indian, Continental and Internations foods for guest and family at the tip of the finger - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'catering-and-food-stalls', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'catering-and-food-stalls.png', 'icon' => 'catering-and-food-stalls.svg'],

            //Trousseau and Wedding Shops - 7
            ['name' => 'Trousseau and Wedding Shops', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'trousseau-and-wedding-shops', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'trousseau-and-wedding-shops.png', 'icon' => 'trousseau-and-wedding-shops.svg'],

            //health and wellness - 8
            ['name' => 'Health and Wellness', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'health-and-wellness', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'health-and-wellness.png', 'icon' => 'wellness-centers-and-gyms.svg'],

            //transport and accommodation - 9
            ['name' => 'Logistics - Transport and Accommodation', 'description' => 'logitics services for wedding guest starting from pick-up to drops-in, accomodation - complete peace of mind for you',  'status' => 0,  'priority' => 0, 'slug' => 'logistics-and-accommodation', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'logistics-transportation-and-accommodation.png', 'icon' => 'logistics-transportation-and-accommodation.svg'],

            //music and entertainment - 10
            ['name' => 'Music and Entertainment', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'music-and-entertainment', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'music-and-entertainment.png', 'icon' => 'music-and-entertainment.svg'],

            //photography and cinematography - 11             
            ['name' => 'Photography and Cinematography', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'photography-and-cinematography', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'photography-and-cinematography.png', 'icon' => 'photography-and-cinematography.svg'],

            //wedding pandits and priests - 12
            ['name' => 'Wedding Pandits and Priests', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-pandits-and-priests', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'wedding-pandits-and-priests.png', 'icon' => 'wedding-priests.svg'],

            //tours and travles - honeymoon packages - 13
            ['name' => 'Tours and Travels - Honeymoon Packages', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'tour-and-travels-honeymoon-packages', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'tour-and-travels-honeymoon-packages.png', 'icon' => 'tour-and-travels-honeymoon-packages.svg'],

            //event security and services - 14
            ['name' => 'Event Security and Services', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'event-security-and-services', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => null, 'imageOne' => 'event-security-and-services.png', 'icon' => 'security-services.svg'],

            // Event Management - 1            
            ['name' => 'Wedding Planners', 'description' => 'Wedding enttainment including groups dancing, band, musiians, ghoriwala and baggiwala etc etc.  - complete peace of mind for you to enjoy',  'status' => 0,  'priority' => 0, 'slug' => 'wedding-planners', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => 1, 'imageOne' => 'wedding-planners.png', 'icon' => 'wedding-planners.svg'],

            // Wedding Venues - 2
            ['name' => 'Resorts', 'description' => 'Resorts Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "resorts.png", "icon" => "resorts.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'resorts', 'path' => 'resorts', 'relation' => ''],

            ['name' => 'Destinations', 'description' => 'Destination Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "destination.png", "icon" => "destination.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'destinations', 'path' => 'destination', 'relation' => ''],

            ['name' => 'Beach & Island', 'description' => 'Beach & Island Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "beach.png", "icon" => "beach.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'beach-island-weddings', 'path' => 'beach', 'relation' => ''],

            ['name' => 'Hotels', 'description' => 'Hotel Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "hotels.png", "icon" => "hotels.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'hotels', 'path' => 'hotels', 'relation' => ''],
            
            ['name' => 'Lawns & Farmhouses', 'description' => 'Lawns and Farmhouse Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "lawns-and-farmhouses.png", "icon" => "lawns-and-farmhouses.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'lawns-and-farmhouses', 'path' => 'lawns-and-farmhouses', 'relation' => ''],

            ['name' => 'Palaces & Forts', 'description' => ' Palace & Forts Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "palace-and-forts.png", "icon" => "palance-and-forts.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'palace-and-forts', 'path' => 'palace-and-forts', 'relation' => ''],

            ['name' => 'Amusement Parks', 'description' => 'Amusement Parks Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "amusement-parks.png", "icon" => "amusement-parks.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'amusements-parks', 'path' => 'amusement-parks', 'relation' => ''],

            ['name' => 'Cruise and Boats', 'description' => 'Cruise Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "cruise-and-boats.png", "icon" => "cruise-and-boats.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'cruise-and-boats', 'path' => 'cruise-and-boats', 'relation' => ''],

            ['name' => 'Place of Worships', 'description' => 'Place of Worship Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "place-of-worships.png", "icon" => "place-of-worships.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'place-of-worships', 'path' => 'place-of-worships', 'relation' => ''],

            ['name' => 'Garden Weddings', 'description' => 'Garden Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "gardens.png", "icon" => "gardens.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'gardens', 'path' => 'gardens', 'relation' => ''],

            ['name' => 'Banquent Halls', 'description' => 'Banquent Halls Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "banquet-halls.png", "icon" => "banquet-halls.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'banquent-halls', 'path' => 'banquet-halls', 'relation' => ''],

            ['name' => 'Community Centers', 'description' => 'Community Center Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "community-centers.png", "icon" => "community-centers.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'community-centers', 'path' => 'community-centers', 'relation' => ''],

            ['name' => 'Kalyan Mandapam', 'description' => 'Kalyan Mandapam Weddings', 'status' => 0, 'parent_id' => 2, 'imageOne' => "kalyan-mandapams.png", "icon" => "kalyan-mandapams.svg", 'admin_id' => 1, 'priority' => 0, 'slug' => 'kalyan-mandapams', 'path' => 'kalyan-mandapams', 'relation' => ''],

            //invitation cards and favours - 3
            ['name' => 'Invitation Cards', 'description' => 'Wedding Card Designs',  'status' => true,  'priority' => 0, 'slug' => 'invitation-cards',  'admin_id' => 1, 'parent_id' => 3, 'imageOne' => "invitation-cards.png", "icon" => "invitation-cards.svg"],

            ['name' => 'Favors & Gifts', 'description' => 'Wedding Favors and Gifts Description',  'status' => true,  'priority' => 0, 'slug' => 'favors-and-gifts',  'admin_id' => 1, 'parent_id' => 3, 'imageOne' => "favors-and-gifts.png", 'icon' => "favors-and-gifts.svg"],

            ['name' => 'Wedding Stationery', 'description' => 'Wedding Stationery',  'status' => true,  'priority' => 0,  'slug' => 'wedding-stationery',  'admin_id' => 1, 'parent_id' => 3, 'imageOne' => "wedding-stationery.png", "icon" => "wedding-stationery.svg"],

            //wedding theme creators - 4
            ['name' => 'Lighting designers', 'description' => 'Wedding Lighting Designers',  'status' => true,  'priority' => 0, 'slug' => 'lighting-designers',  'admin_id' => 1, 'parent_id' => 4, 'imageOne' => "lighting-designers.png", "icon" => "lighting-designers.svg"],

            ['name' => 'Flower Decorators', 'description' => 'Wedding Flow Decorators', 'status' => 0, 'parent_id' => 4, 'admin_id' => 1, 'priority' => 0, 'slug' => 'flower-decorators',   'imageOne' => "flower-decorators.png", 'icon' => "flower-decorators.svg"],

            ['name' => 'Wedding Decors', 'description' => 'Wedding Decors Description',  'status' => true,  'priority' => 0, 'slug' => 'wedding-decors',  'admin_id' => 1, 'parent_id' => 4, 'imageOne' => "wedding-Decors.png", "icon" => "wedding-Decors.svg"],

            //Wedding Wear Styles and Makeups - 5
            ['name' => 'Groom Styles and Wears', 'description' => 'Wedding Groom Styles and Wear Description',  'status' => true,  'priority' => 0, 'slug' => 'groom-styles-and-wears', 'path' => 'groom-wear', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "groom-styles-and-wears.png", "icon" => "groom-styles-and-wears.svg"],

            ['name' => 'Bridal Styles and Wears', 'description' => 'Wedding Bride Styles and Wear Description',  'status' => true,  'priority' => 0, 'slug' => 'bridal-styles-and-wears',  'path' => 'bride-wear', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "bridal-styles-and-wears.png", 'icon' => "bridal-styles-and-wears.svg"],

            ['name' => 'Bridal Makeup Artists', 'description' => 'Wedding Bridal Makeup Artists Description',  'status' => true,  'priority' => 0, 'slug' => 'bridal-makeup-artists',  'path' => 'bride-makeup', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "bridal-makeup-artists.png", 'icon' => "bridal-makeup-artists.svg"],

            ['name' => 'Groom Makeup Artists', 'description' => 'Wedding Makeup Artists Description',  'status' => true,  'priority' => 0, 'slug' => 'groom-makeup-artists',  'path' => 'groom-makeup', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "groom-makeup-artists.png", 'icon' => "groom-makeup-artists.svg"],

            ['name' => 'Family Makeup Artists', 'description' => 'Wedding Family Makeup Artists Description',  'status' => true,  'priority' => 0, 'slug' => 'family-makeup-artists',  'path' => 'famlly-makeup', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "family-makeup-artists.png", 'icon' => "family-makeup-artists.svg"],

            ['name' => 'Wedding Stylists and  Designers', 'description' => 'Wedding Stylists and Designer Description',  'status' => true,  'priority' => 0, 'slug' => 'wedding-stylists-and-designers',  'path' => 'stylist-designer', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "wedding-stylists-and-designers.png", "icon" => "wedding-stylists-and-designers.svg"],

            ['name' => 'Bridal Mehendi Artists', 'description' => 'Wedding Bridal Mehendi Artists Description',  'status' => true,  'priority' => 0, 'slug' => 'bridal-mehendi-artists',  'path' => 'mehndi-artist', 'admin_id' => 1, 'parent_id' => 5, 'imageOne' => "bridal-mehendi-artists.png", 'icon' => "bridal-mehendi-artists.svg"],

            //food and stalls - 6
            ['name' => 'Caterers and Catering', 'description' => 'Caterers for Marriages', 'status' => 0, 'parent_id' => 6, 'admin_id' => 1, 'priority' => 0, 'slug' => 'caterers-and-catering',   'imageOne' => "caterers-and-catering.png", 'icon' => "caterers-and-catering.svg"],

            ['name' => 'Cakes', 'description' => 'Wedding Cakes Description',  'status' => true,  'priority' => 0, 'slug' => 'cakes',  'admin_id' => 1, 'parent_id' => 6, 'imageOne' => "cakes.png", 'icon' => "cakes.svg"],
            
            ['name' => 'Home Catering', 'description' => 'Home Catering',  'status' => true,  'priority' => 0, 'slug' => 'home-catering',  'admin_id' => 1, 'parent_id' => 6, 'imageOne' => "home-catering.png", 'icon' => "home-catering.svg"],

            ['name' => 'Chaat & Food Stalls', 'description' => 'Chaat and Food Stalls for Marriages',  'status' => true,  'priority' => 0, 'slug' => 'chaat-and-food-stalls',  'admin_id' => 1, 'parent_id' => 6, 'imageOne' => "chaat-and-food-stalls.png", "icon" => "chaat-and-food-stalls.svg"],

            ['name' => 'Wine and Bartenders', 'description' => 'Wedding Bartenders Description',  'status' => true,  'priority' => 0, 'slug' => 'wine-and-bartenders',  'admin_id' => 1, 'parent_id' => 6, 'imageOne' => "wine-and-bartenders.png", 'icon' => 'wine-and-bartenders.svg'],

            //Trousseau and Wedding Shops - 7
            ['name' => 'Jewellery Stores', 'description' => 'Jewellery Stores for Marriages', 'status' => 0, 'parent_id' => 7, 'admin_id' => 1, 'priority' => 0, 'slug' => 'jewellery-stores',   'imageOne' => "jewellery-stores.png", "icon" => "jewellery-stores.svg"],

            ['name' => 'Bridal Jewellery', 'description' => 'Wedding Bridal Jewellery',  'status' => true,  'priority' => 0, 'slug' => 'bridal-jewellery',  'admin_id' => 1, 'parent_id' => 7, 'imageOne' => "bridal-jewellery.png", 'icon' => "bridal-jewellery.svg"],

            ['name' => 'Bridal Jewellery On Rent', 'description' => 'Wedding Bridal Jewellery on Rent',  'status' => true,  'priority' => 0, 'slug' => 'bridal-jewellery-on-rent',  'admin_id' => 1, 'parent_id' => 7, 'imageOne' => "bridal-jewellery-on-rent.png", 'icon' => "bridal-jewellery-on-rent.svg"],

            ['name' => 'Clothing Rentals', 'description' => 'Wedding Clothing Rentals Description',  'status' => true,  'priority' => 0, 'slug' => 'clothing-rentals',  'admin_id' => 1, 'parent_id' => 7, 'imageOne' => "clothing-rentals.png", "icon" => "clothing-rentals.svg"],

            //Health and Beauty - 8
            ['name' => 'Wellness Centers and Gyms', 'description' => 'Health and Beauty Centers for Marraiges', 'status' => 0, 'parent_id' => 8, 'admin_id' => 1, 'priority' => 0, 'slug' => 'wellness-centers-and-gyms',   'imageOne' => "wellness-centers-and-gyms.png", 'icon' => "wellness-centers-and-gyms.svg"],

            //logistics- 9
            ['name' => 'Guest Accommodation', 'description' => 'Wedding Guests Acomodation',  'status' => true,  'priority' => 0, 'slug' => 'guest-accommodation', 'relation' => '', 'path' => '',  'admin_id' => 1, 'parent_id' => 9, 'imageOne' => 'guest-accommodation.png', 'icon' => 'guest-accommodation.svg'],
            
            ['name' => 'Transportation', 'description' => 'Transporters for Marriages for Vans, Buss and Luxury Vehicles', 'status' => true, 'parent_id' => 9, 'admin_id' => 1, 'priority' => 0, 'slug' => 'transportation',   'imageOne' => "transportation.png", "icon" => "transportation.svg", 'relation' => 'logistics', 'path' => 'logistics'],

            //music and entertainers - 10         
            ['name' => 'Choreographers', 'description' => 'Wedding Choreographers Description',  'status' => true,  'priority' => 0, 'slug' => 'choreographers',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "choreographers.png", "icon" => "choreographers.svg"],

            ['name' => 'Bandbaja', 'description' => 'Bandbaja wala for Weddings',  'status' => true,  'priority' => 0, 'slug' => 'bandbaja',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "bandbaja.png", 'icon' => 'bandbaja.svg'],

            ['name' => 'Anchors', 'description' => 'Wedding Anchors',  'status' => true,  'priority' => 0, 'slug' => 'anchors',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "anchors.png", 'icon' => 'anchors.svg'],

            ['name' => 'Ghoriwala , Baggi & Palki wale', 'description' => 'Goriwala, Baggi & Palki Wale',  'status' => true,  'priority' => 0, 'slug' => 'ghoriwala-baggi-and-palkiwale',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "ghoriwala-baggi-and-palkiwala.png", 'icon' => "ghoriwala-baggi-and-palkiwala.svg"],

            ['name' => 'Stage and Audio Video Artists ', 'description' => 'Goriwala, Baggi & Palki Wale',  'status' => true,  'priority' => 0, 'slug' => 'stage-and-audio-videos-artists',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "stage-and-audio-videos-artists.png", 'icon' => "stage-and-audio-videos-artists.svg"],

            ['name' => 'Singers and Dancers Groups', 'description' => 'Goriwala, Baggi & Palki Wale',  'status' => true,  'priority' => 0, 'slug' => 'singer-and-dance-groups',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "singers-and-dancers-groups.png", 'icon' => "singers-and-dancers-groups.svg"],

            ['name' => 'DJ/ Musicians/ Entertainment', 'description' => 'DJ, Musicians and Entertainment Artist Groups',  'status' => true,  'priority' => 0, 'slug' => 'dj-musicians-entertainment',  'admin_id' => 1, 'parent_id' => 10, 'imageOne' => "dj-musicians-entertainment.png", "icon" => "dj-musicians-entertainment.svg"],

            //photography and cinematography - 11   
            ['name' => 'Prewed Photographers', 'description' => 'Wedding Prewed Photographers',  'status' => true,  'priority' => 0, 'slug' => 'prewed-photographers',  'admin_id' => 1, 'parent_id' => 11, 'imageOne' => "prewed-photographers.png", "icon" => "prewed-photographers.svg"],
            
            ['name' => 'Prewed Videographers', 'description' => 'Wedding Prewed Video Graphers',  'status' => true,  'priority' => 0, 'slug' => 'prewed-videographers',  'admin_id' => 1, 'parent_id' => 11, 'imageOne' => "prewed-videographers.png", "icon" => "prewed-videographers.svg"],

            ['name' => 'Photographers', 'description' => 'Wedding Photographers',  'status' => true,  'priority' => 0, 'slug' => 'photographers',  'admin_id' => 1, 'parent_id' => 11, 'imageOne' => "photographers.png", "icon" => "photographers.svg"],

            ['name' => 'VideoGraphers', 'description' => 'Wedding Video Graphers',  'status' => true,  'priority' => 0, 'slug' => 'videographers',  'admin_id' => 1, 'parent_id' => 11, 'imageOne' => "videoGraphers.png", 'icon' => "videoGraphers.svg"],

            //wedding priests - 12
            ['name' => 'Wedding Priests', 'description' => 'Wedding Pandits and Priests',  'status' => true,  'priority' => 0, 'slug' => 'wedding-priests',  'admin_id' => 1, 'parent_id' => 12, 'imageOne' => "wedding-priests.png", "icon" => "wedding-priests.svg"],

            //tours and travles - honeymoon packages - 13
            ['name' => 'Honeymoon Planners', 'description' => 'Honeymoon Planners',  'status' => true,  'priority' => 0, 'slug' => 'honeymoon-planners',  'admin_id' => 1, 'parent_id' => 13, 'imageOne' => "honeymoon-planners.png", 'icon' => "honeymoon-planners.svg"],

            ['name' => 'Honeymoon Packages', 'description' => 'Honeymonn Packages',  'status' => true,  'priority' => 0, 'slug' => 'honeymoon-packages',  'admin_id' => 1, 'parent_id' => 13, 'imageOne' => "honeymoon-packages.png", "icon" => "honeymoon-planners.svg"],

            //event security and services - 14
            ['name' => 'Security Services', 'description' => 'Security Service Providers for Marraiges',  'status' => true,  'priority' => 0, 'slug' => 'security-services',  'admin_id' => 1, 'parent_id' => 14, 'imageOne' => "security-services.png", "icon" => "security-services.svg"],

        ];

        foreach ($categories as $key => $val) {
            categoryMaster::create($val);
        }
    }
}
