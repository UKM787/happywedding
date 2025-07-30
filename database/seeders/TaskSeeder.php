<?php

namespace Database\Seeders;

use App\Models\Admin\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [

            //Marriage Planning
            [
                'name' => 'Check if your wedding date is on an auspicious day', 'description' => 'Check if your wedding date is on an auspicious day', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Do you want a destination wedding?', 'description' => 'Do you want a destination wedding?', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Short list date options for all pre-wedding functions', 'description' => 'Short list date options for all pre-wedding functions', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Decide whether or not you"d like to use a wedding planner', 'description' => 'Decide whether or not you"d like to use a wedding planner', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Confirm wedding style', 'description' => 'Confirm wedding style', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Learn about different wedding styles', 'description' => 'Learn about different wedding styles', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Fill in missing addresses on the guest list', 'description' => 'Fill in missing addresses on the guest list', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Send out e-invites using our guest list tool', 'description' => 'Send out e-invites using our guest list tool', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Religious Wedding: Book appointment with priest / pandit etc.', 'description' => 'Religious Wedding: Book appointment with priest / pandit etc.', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Finalize the priest/pandit', 'description' => 'Finalize the priest/pandit', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Check wedding invitation inspirations and designs', 'description' => 'Check wedding invitation inspirations and designs', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Check RSVPs and follow up with the unconfirmed guests on guest list tool', 'description' => 'Check RSVPs and follow up with the unconfirmed guests on guest list tool', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],
            [
                'name' => 'Gather vendors for a venue visit', 'description' => 'Gather vendors for a venue visit', 'status' => 0,'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 1
            ],

            // Bridal Accessories
            [
                'name' => 'Check our articles for outfit inspiration', 'description' => 'Check our articles for outfit inspiration', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            [
                'name' => 'Shortlist your wedding outfit', 'description' => 'Shortlist your wedding outfit', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            [
                'name' => 'Buy outfits for all pre-wedding occasions', 'description' => 'Buy outfits for all pre-wedding occasions', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            [
                'name' => 'Shortlist and buy bride\'s shoes', 'description' => 'Shortlist and buy bride\'s shoes', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            [
                'name' => 'Buy all other bridal accessories', 'description' => 'Buy all other bridal accessories', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            [
                'name' => 'Attend fittings for bridal lehenga and all other wedding and pre-wedding outfits', 'description' => 'Attend fittings for bridal lehenga and all other wedding and pre-wedding outfits', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 2
            ],
            //Groom\'s Accessories
            [
                'name' => 'Find outfit inspirations for the groom', 'description' => 'Find outfit inspirations for the groom', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 3
            ],
            [
                'name' => 'Shortlist groom\'s outfit', 'description' => 'Shortlist groom\'s outfit', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 3
            ],
            [
                'name' => 'Shortlist and buy shoes for the groom', 'description' => 'Shortlist and buy shoes for the groom', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 3
            ],
            [
                'name' => 'Buy all other accessories for the groom', 'description' => 'Buy all other accessories for the groom', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 3
            ],
            //Catering
            [
                'name' => 'Short list caterers', 'description' => 'Short list caterers', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 4
            ],
            [
                'name' => 'Organize menu tasting with shortlisted caterer', 'description' => 'Organize menu tasting with shortlisted caterer', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 4
            ],
            [
                'name' => 'Shortlist wedding cake vendor', 'description' => 'Shortlist wedding cake vendor', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 4
            ],
            [
                'name' => 'Order alcohol for your wedding functions', 'description' => 'Order alcohol for your wedding functions', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 4
            ],
            //Entertainment
            [
                'name' => 'Shortlist DJ', 'description' => 'Shortlist DJ', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 5
            ],
            [
                'name' => 'Shortlist choreographer', 'description' => 'Shortlist choreographer', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 5
            ],
            [
                'name' => 'Finalize and book vendors for the Baraat', 'description' => 'Finalize and book vendors for the Baraat', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 5
            ],
            [
                'name' => 'Add a fun touch for your wedding guests by reserving a photobooth', 'description' => 'Add a fun touch for your wedding guests by reserving a photobooth', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 5
            ],
            [
                'name' => 'Finalise music for the wedding and pre-wedding events', 'description' => 'Finalise music for the wedding and pre-wedding events', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 5
            ],
            //Flowers Decoration
            [
                'name' => ' Start looking at florists', 'description' => ' Start looking at florists', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 6
            ],
            [
                'name' => 'Look for decor inspiration', 'description' => 'Look for decor inspiration', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 6
            ],
            [
                'name' => 'Short list decor vendors', 'description' => 'Short list decor vendors', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 6
            ],
            [
                'name' => 'Browse through decor vendors for the wedding and pre-wedding functions', 'description' => 'Browse through decor vendors for the wedding and pre-wedding functions', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 6
            ],
            //Health and Beauty
            [
                'name' => 'Choose a bridal makeup look', 'description' => 'Choose a bridal makeup look', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Shortlist bridal makeup artists', 'description' => 'Shortlist bridal makeup artists', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Finalize all dates on which you\'ll need the bridal makeup artist', 'description' => 'Finalize all dates on which you\'ll need the bridal makeup artist', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Check for fitness program', 'description' => 'Check for fitness program', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Join a fitness program', 'description' => 'Join a fitness program', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Fix up a date for a trial with your makeup artist', 'description' => 'Fix up a date for a trial with your makeup artist', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Start pre-bridal skincare packages', 'description' => 'Start pre-bridal skincare packages', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Decide on hair and makeup styles', 'description' => 'Decide on hair and makeup styles', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'If you want a haircut, go now!', 'description' => 'If you want a haircut, go now!', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            [
                'name' => 'Take care of your skin', 'description' => 'Take care of your skin', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 7
            ],
            // Honeymoon
            [
                'name' => 'Start planning your honeymoon', 'description' => 'Start planning your honeymoon', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 8
            ],
            [
                'name' => 'Pack your honeymoon bags', 'description' => 'Pack your honeymoon bags', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 8
            ],
            // Jewellery
            [
                'name' => 'Check our range of jewellery designers', 'description' => 'Check our range of jewellery designers', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 9
            ],
            [
                'name' => 'Look for inspiration and designs for wedding rings', 'description' => 'Look for inspiration and designs for wedding rings', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 9
            ],
            //Photography and Video
            [
                'name' => 'Choose photography / videography services for each wedding function - candid, cinema etc.', 'description' => 'Choose photography / videography services for each wedding function - candid, cinema etc.', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 10
            ],
            [
                'name' => 'Meet with a few photographers', 'description' => 'Meet with a few photographers', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 10
            ],
            [
                'name' => 'Short list videographers', 'description' => 'Short list videographers', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 10
            ],
            [
                'name' => 'Agree on timelines & deliverables with the photographer - when will you receive the images, in what format etc.', 'description' => 'Agree on timelines & deliverables with the photographer - when will you receive the images, in what format etc.', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 10
            ],
            [
                'name' => 'Plan and confirm your pre-wedding shoot', 'description' => 'Plan and confirm your pre-wedding shoot', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 10
            ],
            // Transportation
            [
                'name' => 'Look at transportation options for your guests', 'description' => 'Look at transportation options for your guests', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 11
            ],
            [
                'name' => 'Shortlist some transportation vendors', 'description' => 'Shortlist some transportation vendors', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 11
            ],
            [
                'name' => 'Last minute check on the transportation', 'description' => 'Last minute check on the transportation', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 11
            ],
            // Wedding Cards
            [
                'name' => 'Send out wedding invitations', 'description' => 'Send out wedding invitations', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 12
            ],
            // Booking Vendors
            [
                'name' => 'Ghori Wala', 'description' => 'Ghori Wala for Marriage', 'status' => 0, 'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 13
            ],
            // Miscellenous
            [
                'name' => 'Delegate responsibilities', 'description' => 'Delegate responsibilities', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Create your wedding hashtag', 'description' => 'Create your wedding hashtag', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Organize bachelor and bachelorette parties', 'description' => 'Organize bachelor and bachelorette parties', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Make sure your wedding party has ordered their attire', 'description' => 'Make sure your wedding party has ordered their attire', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Buy a wedding gift for your spouse-to-be', 'description' => 'Buy a wedding gift for your spouse-to-be', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Think of a signature cocktail', 'description' => 'Think of a signature cocktail', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Contact close family and friends for Sangeet/other performances', 'description' => 'Contact close family and friends for Sangeet/other performances', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Organize youngster\'s party', 'description' => 'Organize youngster\'s party', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Follow up on your guest\'s arrival dates', 'description' => 'Follow up on your guest\'s arrival dates', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Write a sweet note to your partner', 'description' => 'Write a sweet note to your partner', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Pull together any last-minute essentials', 'description' => 'Pull together any last-minute essentials', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Confirm final details with all your vendors and put tip money aside', 'description' => 'Confirm final details with all your vendors and put tip money aside', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Find makeup salon options for friends and family', 'description' => 'Find makeup salon options for friends and family', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Prepare bridal bag to take to the venue', 'description' => 'Prepare bridal bag to take to the venue', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Download Wedshoots App', 'description' => 'Download Wedshoots App', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Download your wedding photographs from Wedshoots', 'description' => 'Download your wedding photographs from Wedshoots', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug' => 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],
            [
                'name' => 'Rate and review your vendors on WeddingWire', 'description' => 'Rate and review your vendors on WeddingWire', 'status' => 0,  'priority' => 0, 'icon' => 'fas fa-tshirt', 'slug'=> 'booking-vendors',  'created_at' => '2020-12-28 18:27:36', 'updated_at' => '2020-12-30 19:15:30', 'admin_id' => 1, 'taskmaster_id' => 14
            ],


        ];

        foreach ($tasks as $key => $val) {
            Task::create($val);
        }
    }
}
