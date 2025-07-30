<?php

namespace Database\Seeders;

use App\Models\SiteDefault;
use Illuminate\Database\Seeder;

class SiteDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $siteDefaults = [
            [
                'name' => 'slider',
                'img'  => '/defaultsv1/siteslider/banner1.png',
                'slug' => 'sliderone'
            ],
            [
                'name' => 'slider',
                'img'  => '/defaultsv1/siteslider/banner2.png',
                'slug' => 'slidertwo'
            ],
            [
                'name' => 'slider',
                'img'  => '/defaultsv1/siteslider/banner3.png',
                'slug' => 'sliderthree'
            ],
            [
                'name' => 'invitationcover',
                'img'  => '/defaultsv1/invitationv0/cover1.png',
                'slug' => 'invitationcover'
            ],
            [
                'name' => 'invitationcover',
                'img'  => '/defaultsv1/invitationv0/cover2.png',
                'slug' => 'invitationcover'
            ],
            [
                'name' => 'invitationcover',
                'img'  => '/defaultsv1/invitationv0/cover3.png',
                'slug' => 'invitationcover'
            ],
            [
                'name' => 'invitationcover',
                'img'  => '/defaultsv1/invitationv0/cover4.png',
                'slug' => 'invitationcover'
            ],
            [
                'name' => 'invitationcover',
                'img'  => '/defaultsv1/invitationv0/cover5.png',
                'slug' => 'invitationcover'
            ],
            [
                'name' => 'savedate',
                'img'  => '/defaultsv1/savedatev0/savedate1.png',
                'slug' => 'savedate'
            ],
            [
                'name' => 'savedate',
                'img'  => '/defaultsv1/savedatev0/savedate2.png',
                'slug' => 'savedate'
            ],
            [
                'name' => 'savedate',
                'img'  => '/defaultsv1/savedatev0/savedate3.png',
                'slug' => 'savedate'
            ],
            [
                'name' => 'savedate',
                'img'  => '/defaultsv1/savedatev0/savedate4.png',
                'slug' => 'savedate'
            ],
            [
                'name' => 'savedate',
                'img'  => '/defaultsv1/savedatev0/savedate5.png',
                'slug' => 'savedate'
            ],
            [
                'name' => 'storyimageone',
                'img'  =>  '/defaultsv1/coverstoryv0/story1.png',
                'slug' => 'storyimageone'
            ],
            [
                'name' => 'storyimageone',
                'img'  =>  '/defaultsv1/coverstoryv0/story2.png',
                'slug' => 'storyimageone'
            ],
            [
                'name' => 'storyimageone',
                'img'  =>  '/defaultsv1/coverstoryv0/story3.png',
                'slug' => 'storyimageone'
            ],
            [
                'name' => 'storyimageone',
                'img'  =>  '/defaultsv1/coverstoryv0/story4.png',
                'slug' => 'storyimageone'
            ],
            [
                'name' => 'storyimageone',
                'img'  =>  '/defaultsv1/coverstoryv0/story5.png',
                'slug' => 'storyimageone'
            ],
            [
                'name' => 'storyimagetwo',
                'img'  => '/defaultsv1/coverstoryv0/story6.png',
                'slug' => 'storyimagetwo'
            ],
            [
                'name' => 'storyimagetwo',
                'img'  => '/defaultsv1/coverstoryv0/story7.png',
                'slug' => 'storyimagetwo'
            ],
            [
                'name' => 'storyimagetwo',
                'img'  => '/defaultsv1/coverstoryv0/story8.png',
                'slug' => 'storyimagetwo'
            ],
            [
                'name' => 'storyimagetwo',
                'img'  => '/defaultsv1/coverstoryv0/story9.png',
                'slug' => 'storyimagetwo'
            ],
            [
                'name' => 'storyimagetwo',
                'img'  => '/defaultsv1/coverstoryv0/story10.png',
                'slug' => 'storyimagetwo'
            ],
            [
                'name' => 'storyimagethree',
                'img'  => '/defaultsv1/coverstoryv0/story11.png',
                'slug' => 'storyimagethree'
            ],
            [
                'name' => 'storyimagethree',
                'img'  => '/defaultsv1/coverstoryv0/story12.png',
                'slug' => 'storyimagethree'
            ],
            [
                'name' => 'storyimagethree',
                'img'  => '/defaultsv1/coverstoryv0/story13.png',
                'slug' => 'storyimagethree'
            ],
            [
                'name' => 'storyimagethree',
                'img'  => '/defaultsv1/coverstoryv0/story14.png',
                'slug' => 'storyimagethree'
            ],
            [
                'name' => 'storyimagethree',
                'img'  => '/defaultsv1/coverstoryv0/story15.png',
                'slug' => 'storyimagethree'
            ],
            [
                'name' => 'storyimagefour',
                'img'  => '/defaultsv1/coverstoryv0/story16.png',
                'slug' => 'storyimagefour'
            ],
            [
                'name' => 'storyimagefour',
                'img'  => '/defaultsv1/coverstoryv0/story17.png',
                'slug' => 'storyimagefour'
            ],
            [
                'name' => 'storyimagefour',
                'img'  => '/defaultsv1/coverstoryv0/story18.png',
                'slug' => 'storyimagefour'
            ],
            [
                'name' => 'storyimagefour',
                'img'  => '/defaultsv1/coverstoryv0/story19.png',
                'slug' => 'storyimagefour'
            ],
            [
                'name' => 'storyimagefour',
                'img'  => '/defaultsv1/coverstoryv0/story20.png',
                'slug' => 'storyimagefour'
            ],
            [
                'name' => 'storyimagefive',
                'img'  => '/defaultsv1/coverstoryv0/story21.png',
                'slug' => 'storyimagefive'
            ],
            [
                'name' => 'storyimagefive',
                'img'  => '/defaultsv1/coverstoryv0/story22.png',
                'slug' => 'storyimagefive'
            ],
            [
                'name' => 'storyimagefive',
                'img'  => '/defaultsv1/coverstoryv0/story23.png',
                'slug' => 'storyimagefive'
            ],
            [
                'name' => 'storyimagefive',
                'img'  => '/defaultsv1/coverstoryv0/story24.png',
                'slug' => 'storyimagefive'
            ],
            [
                'name' => 'storyimagefive',
                'img'  => '/defaultsv1/coverstoryv0/story25.png',
                'slug' => 'storyimagefive'
            ],
            [
                'name' => 'storyimagesix',
                'img'  => '/defaultsv1/coverstoryv0/story26.png',
                'slug' => 'storyimagesix'
            ],
            [
                'name' => 'storyimagesix',
                'img'  => '/defaultsv1/coverstoryv0/story27.png',
                'slug' => 'storyimagesix'
            ],
            [
                'name' => 'storyimagesix',
                'img'  => '/defaultsv1/coverstoryv0/story28.png',
                'slug' => 'storyimagesix'
            ],
            [
                'name' => 'storyimagesix',
                'img'  => '/defaultsv1/coverstoryv0/story29.png',
                'slug' => 'storyimagesix'
            ],
            [
                'name' => 'storyimagesix',
                'img'  => '/defaultsv1/coverstoryv0/story30.png',
                'slug' => 'storyimagesix'
            ],
            [
                'name' => 'ceramony-ladiesdress',
                'img'  => '/defaultsv1/ceramoniesv1/ladiesdress/ladiesdress01.png',
                'slug' => 'ceramony-ladiesdress1'
            ],
            [
                'name' => 'ceramony-ladiesdress',
                'img'  => '/defaultsv1/ceramoniesv1/ladiesdress/ladiesdress02.png',
                'slug' => 'ceramony-ladiesdress2'
            ],
            [
                'name' => 'ceramony-ladiesdress',
                'img'  => '/defaultsv1/ceramoniesv1/ladiesdress/ladiesdress03.png',
                'slug' => 'ceramony-ladiesdress3'
            ],
            [
                'name' => 'ceramony-ladiesdress',
                'img'  => '/defaultsv1/ceramoniesv1/ladiesdress/ladiesdress04.png',
                'slug' => 'ceramony-ladiesdress4'
            ],
            [
                'name' => 'ceramony-ladiesdress',
                'img'  => '/defaultsv1/ceramoniesv1/ladiesdress/ladiesdress05.png',
                'slug' => 'ceramony-ladiesdress5'
            ],
            [
                'name' => 'ceramony-gentsdress',
                'img'  => '/defaultsv1/ceramoniesv1/gentsdress/gentsdress01.png',
                'slug' => 'ceramony-gentsdress1'
            ],
            [
                'name' => 'ceramony-gentsdress',
                'img'  => '/defaultsv1/ceramoniesv1/gentsdress/gentsdress02.png',
                'slug' => 'ceramony-gentsdress2'
            ],
            [
                'name' => 'ceramony-gentsdress',
                'img'  => '/defaultsv1/ceramoniesv1/gentsdress/gentsdress03.png',
                'slug' => 'ceramony-gentsdress3'
            ],
            [
                'name' => 'ceramony-gentsdress',
                'img'  => '/defaultsv1/ceramoniesv1/gentsdress/gentsdress04.png',
                'slug' => 'ceramony-gentsdress4'
            ],
            [
                'name' => 'ceramony-gentsdress',
                'img'  => '/defaultsv1/ceramoniesv1/gentsdress/gentsdress05.png',
                'slug' => 'ceramony-gentsdress5'
            ],
            [
                'name' => 'avatar',
                'img'  => '/defaultsv1/avatar.png',
                'slug' => 'avatar'
            ],


        ];

        foreach ($siteDefaults as $key => $value) {
            SiteDefault::create($value);
        }
    }
}
