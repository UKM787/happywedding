<?php

namespace Database\Seeders;

use App\Models\Admin\Tag;
use Illuminate\Database\Seeder;
use App\Models\Admin\CategoryMaster;

class TagMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = array(
            array('id' => '1', 'name' => 'Bridal Lehenga', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-lehenga.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-lehenga', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '2', 'name' => 'Wedding Sarees', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-sarees.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-sarees', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '3', 'name' => 'Engagement', 'status' => '0', 'priority' => '0', 'icon' => 'engagement.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'engagement', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '4', 'name' => 'Mehndi', 'status' => '0', 'priority' => '0', 'icon' => 'mehndi.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'mehndi', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '5', 'name' => 'Blouse Designs', 'status' => '0', 'priority' => '0', 'icon' => 'blouse-designs.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'blouse-designs', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '6', 'name' => 'Jewellery', 'status' => '0', 'priority' => '0', 'icon' => 'jewellery.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'jewellery', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '7', 'name' => 'Bridal Jewellery', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-jewellery.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-jewellery', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '8', 'name' => 'Engagement Rings', 'status' => '0', 'priority' => '0', 'icon' => 'engagement-rings.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'engagement-rings', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '9', 'name' => 'Floral Jewellery', 'status' => '0', 'priority' => '0', 'icon' => 'floral-jewellery.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'floral-jewellery', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '10', 'name' => 'Mehndi', 'status' => '0', 'priority' => '0', 'icon' => 'mehndi.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'mehndi', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '11', 'name' => 'Arabic', 'status' => '0', 'priority' => '0', 'icon' => 'arabic.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'arabic', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '12', 'name' => 'Mehndi Designs', 'status' => '0', 'priority' => '0', 'icon' => 'mehndi-designs.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'mehndi-designs', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '13', 'name' => 'Decor & Ideas', 'status' => '0', 'priority' => '0', 'icon' => 'decor-ideas.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'decor-ideas', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '14', 'name' => 'Wedding Decor', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-decor.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-decor', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '15', 'name' => 'Bridal Entry', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-entry.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-entry', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '16', 'name' => 'Groom Entry', 'status' => '0', 'priority' => '0', 'icon' => 'groom-entry.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'groom-entry', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '17', 'name' => 'Wedding Games', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-games.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-games', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '18', 'name' => 'Wedding Card Designs', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-card-designs.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-card-designs', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '19', 'name' => 'Wedding Gifts', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-gifts.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-gifts', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '20', 'name' => 'Wedding Invitations', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-invitations.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-invitations', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '21', 'name' => 'Wedding Photography', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-photography.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-photography', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '22', 'name' => 'Pre Wedding Shoot', 'status' => '0', 'priority' => '0', 'icon' => 'pre-wedding-shoot.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'pre-wedding-shoot', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '23', 'name' => 'Wedding', 'status' => '0', 'priority' => '0', 'icon' => 'wedding.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '24', 'name' => 'Wedding Photoshoot', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-photoshoot.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-photoshoot', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '25', 'name' => 'Groom Wear', 'status' => '0', 'priority' => '0', 'icon' => 'groom-wear.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'groom-wear', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '26', 'name' => 'Sherwani for Groom', 'status' => '0', 'priority' => '0', 'icon' => 'sherwani-for-groom.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'sherwani-for-groom', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '27', 'name' => 'Wedding Suits for Groom', 'status' => '0', 'priority' => '0', 'icon' => 'wedding-suits-for-groom.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'wedding-suits-for-groom', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '28', 'name' => 'Bridal Makeup & Hair', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-makeup-hair.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-makeup-hair', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '29', 'name' => 'Bridal Makeup', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-makeup.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-makeup', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '30', 'name' => 'Bridal Hairstyles', 'status' => '0', 'priority' => '0', 'icon' => 'bridal-hairstyles.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'bridal-hairstyles', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41'),
            array('id' => '31', 'name' => 'Engagement', 'status' => '0', 'priority' => '0', 'icon' => 'engagement.svg', 'imageOne' => 'tagDefault.png', 'slug' => 'engagement', 'admin_id' => '1', 'deleted_at' => NULL, 'created_at' => '2023-04-13 08:37:30', 'updated_at' => '2023-04-13 11:12:41')
        );

        foreach ($tags as $key => $value) {
            Tag::create($value);
        }
    }
}
