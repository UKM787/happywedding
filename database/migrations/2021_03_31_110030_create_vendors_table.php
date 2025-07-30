<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->foreignId('location_id')->constrained('locationmaster');
            $table->tinyInteger('status')->default(1);
            $table->string('role')->default('vendor');
            $table->tinyInteger('priority')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('slug')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categorymaster');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('vendor_pprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('desgination');
            $table->string('landline')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            //$table->string('whatsapp1')->nullable();;
            $table->string('avatar')->default('vendorDefault.png')->nullable();;
            // $table->string('complex')->nullable();;
            // $table->string('area');
            // $table->string('district');
            // $table->string('zipcode');
            // $table->string('state');
            // $table->string('country')->default('India');
            $table->string('slug');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('vendor_cprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('companyname');
            $table->mediumText('companyinfo');
            $table->mediumText('address');
            //$table->text('area');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('map')->nullable();
            $table->string('establish')->nullable();
            $table->string('gst')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsup');
            $table->string('companyimg')->default('vendorDefault.png');
            $table->string('slug');
            $table->foreignId('location_id')->references('id')->on('locationmaster');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('vendor_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('phone')->unique();
            $table->string('mobile')->unique();;
            $table->string('whatsup');
            $table->string('slug')->nullable();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('vendor_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->foreignId('category_id')->references('id')->on('categorymaster');
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('vendor_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->foreignId('service_master_id')->references('id')->on('servicemaster');
            $table->nullableMorphs('productable');
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ServiceDetails', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('service_master_id')->references('id')->on('servicemaster')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_num');
            $table->string('email');
            $table->string('date')->nullable();
            $table->json('no_of_guests')->nullable();
            $table->json('rooms_selected')->nullable();
            $table->string('party_area')->nullable();
            $table->string('event_time')->nullable();
            $table->string('given_by');
            $table->string('slug');
            $table->morphs('reviewable');
            $table->morphs('productable');
            $table->foreignId('category_id')->references('id')->on('categorymaster');
            $table->foreignId('service_id')->references('id')->on('servicemaster');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('keywords');
            $table->tinyInteger('rating');
            $table->string('given_by');
            $table->string('slug');
            $table->morphs('reviewable');
            $table->morphs('productable');
            $table->foreignId('category_id')->references('id')->on('categorymaster');
            $table->foreignId('service_id')->references('id')->on('servicemaster');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('landline')->nullable();
            $table->string('number_2')->nullable();
            $table->string('email')->nullable();
            $table->string('watsapp')->nullable();
            $table->float('stars')->default(5);
            $table->mediumText('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('landmark')->nullable();
            $table->string('district')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('map')->nullable();
            $table->json('venue_facilities')->nullable();
            $table->json('venue_policies')->nullable();
            $table->json('terms_and_conditions')->nullable();
            $table->json('party_area')->nullable();
            $table->text('images')->nullable();
            $table->text('videos')->nullable();
            $table->json('features')->nullable();
            $table->string('veg_plate')->nullable();
            $table->text('non_veg_plate')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('snapchat_link')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(1);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('venueDefault.png');
            $table->string('slug');
            $table->morphs('venueable');
            $table->foreignId('category_id')->nullable()->references('id')->on('categorymaster')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->references('id')->on('locationmaster');
            // $table->foreignId('service_id')->nullable()->references('id')->on('servicemaster');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('venue_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->foreignId('category_id')->references('id')->on('servicemaster');
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number_1');
            $table->string('number_2');
            //$table->string('type');
            $table->integer('stars');
            $table->string('address1');
            $table->string('address2');
            $table->string('state');
            $table->string('district');
            $table->string('zipcode');
            $table->string('country')->default('India');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('map')->nullable();
            $table->json('accom_facilities')->nullable();
            $table->text('images')->nullable();
            $table->text('videos')->nullable();
            $table->text('about')->nullable();
            $table->text('features')->nullable();
            $table->string('veg_plate')->nullable();
            $table->text('non_veg_plate')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('snapchat_link')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(1);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('venueDefault.png');
            $table->string('slug');
            $table->morphs('accommodatable');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categorymaster');
            $table->foreignId('location_id')->references('id')->on('locationmaster');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('accommodations_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
            $table->string('sleeps');
            $table->string('beds_available');
            $table->string('total_rooms');
            $table->text('room_specifications');
            $table->text('images')->nullable();
            $table->text('videos')->nullable();
            $table->text('room_facilities');
            $table->string('price_per_room');
            $table->string('tax_per_room');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(1);
            $table->string('slug');
            // $table->unsignedBigInteger('accomodation_id')->nullable();
            $table->foreignId('accomodation_id')->references('id')->on('accommodations')->onDelete('cascade');;
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('wvendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description');
            $table->mediumText('address');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('map')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(1);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('venueDefault.png');
            $table->string('slug');
            $table->morphs('wvendorable');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categorymaster');
            $table->foreignId('location_id')->references('id')->on('locationmaster');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('wvservices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('imageOne')->default('vendorDefault.png');
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('slug');
            $table->morphs('wvserviceable');
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->foreign('parent_id')->references('id')->on('categorymaster')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servprivileges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('imageOne')->default('vendorDefault.png');
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('slug');
            $table->morphs('servprivilegeable');
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->foreign('vendor_id')->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('vendor_pprofiles');
        Schema::dropIfExists('vendor_cprofiles');
        Schema::dropIfExists('vendor_employees');
        Schema::dropIfExists('vendor_category');
        Schema::dropIfExists('vendor_service');
        Schema::dropIfExists('ServiceDetails');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('venue_service');
        Schema::dropIfExists('accommodations');
        Schema::dropIfExists('accommodations_rooms');
        Schema::dropIfExists('wvendors');
        Schema::dropIfExists('wvservices');
        Schema::dropIfExists('servprivilegeable');
    }
}
