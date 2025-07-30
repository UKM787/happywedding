<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use ArticlesTableSeeder;
use App\Models\Host\Host;
use App\Models\Host\Guest;
use App\Models\Host\Story;
use App\Models\Host\Member;
use App\Models\SiteDefault;
use App\Models\Admin\Article;
use App\Models\Host\Ceramony;
use App\Models\Host\HostHome;
use App\Models\Host\Savedate;
use App\Models\Guest\GuestHome;
use App\Models\Host\HostOffice;
use App\Models\Host\Invitation;
use Illuminate\Database\Seeder;
use App\Models\Host\HostProfile;
use Database\Seeders\HostSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TaskSeeder;
use App\Models\Guest\GuestFamily;
use App\Models\Guest\GuestOffice;
use App\Models\Host\Subscription;
use Database\Seeders\MovieSeeder;
use App\Models\Guest\GuestProfile;
use App\Models\Host\CeramonyMaster;
use App\Models\Vendor\Service\Venue;
use Database\Seeders\SiteDefaultSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\LocationMasterSeeder;
use Database\Seeders\SubscriptionReccuringSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creating users and hosts
        $this->call([

            SiteDefaultSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            LocationMasterSeeder::class,
            HostSeeder::class,
            CategoryMasterSeeder::class,
            ServiceMasterSeeder::class,
            // VendorMasterSeeder::class,
            TaskMasterSeeder::class,
            VenueSeeder::class,
            TaskSeeder::class,
            CeramonyMasterSeeder::class,
            CompanySeeder::class,
            SubscriptionSeeder::class,
            SubscriptionReccuringSeeder::class,
            //InvitationSeeder::class,
            UserSeeder::class,


            TagMasterSeeder::class,
            ArticleSeeder::class,
            TestimonialSeeder::class,
            // TagSeeder::class,
            //CategorySeeder::class,
            //ProductSeeder::class,
            // ServiceSeeder::class,
            // MovieSeeder::class,

        ]);


        Host::all()->each(function ($host) {
            //creating host, hostprofiles, hosthome, hostoffice
            // $profile = HostProfile::factory()->make();
            // $home = HostHome::factory()->make();
            // $office = HostOffice::factory()->make();
            // $host->profile()->save($profile);
            //$host->home()->save($home);
            //$host->office()->save($office);
            //creating venues, invitation by host
            // $venues = Venue::factory(7)->make();
            // $host->venues()->saveMany($venues);
            // $invitations = Invitation::factory(2)->make();
            // $host->invitations()->saveMany($invitations);
        });
        // Host::factory(20)->create()->each(function ($host) {
        //
        // });

        //  foreach (Host::all() as $host){
        //   foreach($host->invitations as $invitation){
        //     $savedate = Savedate::factory()->make();
        //     $story = Story::factory()->make();
        //     $invitation->savedate()->save($savedate);
        //     $invitation->story()->save($story);
        //     $cermonies = Ceramony::factory(7)->make();
        //     $invitation->ceramonies()->saveMany($cermonies);

        //     $members = Member::factory(7)->make();
        //     $invitation->members()->saveMany($members);
        //     //$guests = Guest::factory(21)->make();
        //     //$invitation->invitedguests()->saveMany($guests);


        //   }
        // }

        // Ceramony::all()->each(function ($ceramony) {
        //     $ceramony->venues()->attach(Venue::inRandomOrder()->take(1)->get(),['invitation_id' => $ceramony->invitation_id]);
        //      /*   $ceramony->guests()->attach(Guest::inRandomOrder()->take(rand(11,21))->get(), ['invitationStatus' => rand(0, 3), 'logistics' => rand(0, 3), 'accommodation' => rand(0, 1)]); */
        // });

        // Invitation::all()->each(function($invitation){
        //         $invitation->invitedguests->each(function($guest){
        //             $guest->ceramonies()->attach(Ceramony::inRandomOrder()->take(1)->get(), ['invitationStatus' => rand(0, 3)]);
        //         });

        //  });
        /*   //'invitation_id' => Invitation::factory()->create() */

        // User::all()->each(function ($user) {
        //     $guestprofile = GuestProfile::factory()->make();
        //     $guesthome = GuestHome::factory()->make();
        //     $guestoffice = GuestOffice::factory()->make();
        //     // $guestarrival = GuestArrival::factory()->make();
        //     // $guestdeparture = GuestDeparture::factory()->make();
        //     $guestfamily = GuestFamily::factory(6)->make();
        //     $user->profile()->save($guestprofile);
        //     $user->home()->save($guesthome);
        //     $user->office()->save($guestoffice);
        //     $user->family()->saveMany($guestfamily);
        //     // $user->guestarrival()->save($guestarrival);
        //     // $user->guestdeparture()->save($guestdeparture);
        // });

        // Invitation::all()->each(function($invitation) {
        //     $invitation->inviteguests()->attach(User::inRandomOrder()->take(rand(0,31))->get(),['status' => rand(0,3),'logistics' => rand(0, 3), 'accommodation' => rand(0, 1), 'host_id' => $invitation->host_id]);
        // });

        // foreach(User::all() as $user){
        //     $invitations= Invitation::inRandomOrder()->take(rand(1,7))->pluck('id');
        //     foreach($invitations as $invitation){
        //         $user->invitations()->sync($invitation,['status' => rand(0,2)]);
        //     }
        //     //$user->invitations()->sync($invitations);
        // }
        // foreach (Invitation::all() as $invitation){
        //     $users = User::inRandomOrder()->take(rand(1,5))->pluck('id');
        //     $invitation->guests()->sync($users);
        // }
        // foreach(User::all() as $user){
        //     $guesthomeaddress = GuestHomeAddress::factory(1)->create();
        // }

        // \App\Models\Guest\GuestHomeAddress::factory(10)->create();
        // \App\Models\Guest\GuestOfficeAddress::factory(10)->create();
        // \App\Models\Guest\GuestFamily::factory(10)->create();
    }
}
