<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\CeramonyMaster;

class CeramonyMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ceramonies = [
            [
                'name'      => 'Roka',
                'imageOne'  => ['/roka/roka01.png', '/roka/roka02.png', '/roka/roka03.png', '/roka/roka04.png', '/roka/roka05.png'],
                'slug'      => 'roka',
                'file'      => 'CardRoka',
                'parent_id' => 1,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Engagement',
                'imageOne'  =>  ['/engagement/engagement01.png', '/engagement/engagement02.png', '/engagement/engagement03.png', '/engagement/engagement04.png', '/engagement/engagement05.png'],
                'slug'       => 'engagement',
                'file'      => 'CardEngagement',
                'parent_id' =>  2,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Sangeet',
                'imageOne'  => ['/sangeet/sangeet01.png', '/sangeet/sangeet02.png', '/sangeet/sangeet03.png', '/sangeet/sangeet04.png', '/sangeet/sangeet05.png'],
                'slug'      => 'sangeet1',
                'file'      => 'CardSangeet',
                'parent_id' => 3,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Haldi',
                'imageOne'  => ['/haldi/haldi01.png', '/haldi/haldi02.png', '/haldi/haldi03.png', '/haldi/haldi04.png', '/haldi/haldi05.png'],
                'slug'      => 'haldi1',
                'file'      => 'CardHaldi',
                'parent_id' => 4,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Mehendi',
                'imageOne'  =>  ['/mehendi/mehendi01.png', '/mehendi/mehendi02.png', '/mehendi/mehendi03.png', '/mehendi/mehendi04.png', '/mehendi/mehendi05.png'],
                'slug'      => 'mehendi1',
                'file'      => 'CardMehendi',
                'parent_id' => 5,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Wedding',
                'imageOne'  =>  ['/wedding/wedding01.png', '/wedding/wedding02.png', '/wedding/wedding03.png', '/wedding/wedding04.png', '/wedding/wedding05.png'],
                'slug'      => 'wedding1',
                'file'      => 'CardWedding',
                'parent_id' => 6,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Reception',
                'imageOne'  =>  ['/reception/reception01.png', '/reception/reception02.png', '/reception/reception03.png', '/reception/reception04.png', '/reception/reception05.png'],
                'slug'      => 'reception1',
                'file'      => 'CardReception',
                'parent_id' => 7,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Tilak',
                'imageOne'  =>  ['/tilak/tilak01.png', '/tilak/tilak02.png', '/tilak/tilak03.png', '/tilak/tilak04.png', '/tilak/tilak05.png'],
                'slug'      => 'tilak1',
                'file'      => 'CardTilak',
                'parent_id' => 8,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Sagan',
                'imageOne'  => ['/sagan/sagan01.png', '/sagan/sagan02.png', '/sagan/sagan03.png', '/sagan/sagan04.png', '/sagan/sagan05.png'],
                'slug'      => 'sagan1',
                'file'      => 'CardSagan',
                'parent_id' => 9,
                'admin_id'   => 1
            ],
            [
                'name'      => 'Custom',
                'imageOne'  =>  ['/custom/custom01.png', '/custom/custom02.png', '/custom/custom03.png', '/custom/custom04.png', '/custom/custom05.png'],
                'slug'      => 'custom1',
                'file'      => 'CardCustom',
                'parent_id' => 10,
                'admin_id'   => 1
            ]
        ];

        foreach ($ceramonies as $key => $value) {
            CeramonyMaster::create($value);
        }
    }
}
