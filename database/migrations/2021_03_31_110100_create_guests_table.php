<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()   {

        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile')->unique();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('parent_id')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('slug')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_profiles', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('fatherName')->nullable();
                $table->string('surname')->nullable();
                $table->string('age')->nullable();
                $table->string('gender')->nullable();
                $table->string('relation')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('mobile');
                $table->string('mobile1')->nullable();
                $table->string('whatsup')->nullable();
                $table->string('imageOne')->nullable()->default('/guests/guestDefault.png');
                $table->string('slug')->nullable();
                $table->unsignedBigInteger('guest_id');
                $table->foreign('guest_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
            });

        Schema::create('guest_homes', function (Blueprint $table) {
            $table->id();
            $table->string('complexName')->nullable();
            $table->string('floor')->nullable();
            $table->string('doorNo')->nullable();
            $table->string('streetNo')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable();
            $table->string('pin')->nullable();
            $table->string('state')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->default('India')->nullable();
            $table->longText('reachus')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('guest_id');
            $table->foreign('guest_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_offices', function (Blueprint $table) {
            $table->id();
            $table->string('officecompanyName')->nullable();
            $table->string('officecomplexName')->nullable();
            $table->string('officefloor')->nullable();
            $table->string('officedoorNo')->nullable();
            $table->string('officestreetNo')->nullable();
            $table->string('officearea')->nullable();
            $table->string('officedistrict')->nullable();
            $table->string('officepin')->nullable();
            $table->string('officestate')->nullable();
            $table->string('officezone')->nullable();
            $table->string('officecountry')->default('India');
            $table->longText('officereachus')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('guest_id');
            $table->foreign('guest_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_families', function (Blueprint $table) {
            $table->id();
            $table->string('familyname')->nullable();
            $table->string('familyage')->nullable();
            $table->string('familygender')->nullable();
            $table->string('familyrelation')->nullable();
            $table->string('familymobile')->nullable();
            $table->string('familyimageOne')->nullable();
            $table->string('familyimageTwo')->nullable();;
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('guest_id');
            $table->foreign('guest_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('short_url', function (Blueprint $table) {
            $table->id();
            $table->longText('short_url');
            $table->longText('long_url');
            $table->timestamps();
        });


        Schema::create('guest_invitation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('invitation_id')->constrained();
            $table->tinyInteger('invite')->default(0);
            $table->tinyInteger('inviteStatus')->default(0);
            $table->tinyInteger('logistics')->default(0);
            $table->tinyInteger('logisticsArrivalStatus')->default(0);
            $table->tinyInteger('logisticsDepartureStatus')->default(0);
            $table->tinyInteger('hostLogisticsArrivalStatus')->default(0);
            $table->tinyInteger('hostLogisticsDepartureStatus')->default(0);
            $table->tinyInteger('accommodation')->default(0);
            $table->tinyInteger('accommodationStatus')->default(0);
            $table->tinyInteger('hostAccommodationStatus')->default(0);
            $table->tinyInteger('sms')->default(0);
            $table->tinyInteger('email')->default(0);
            $table->tinyInteger('post')->default(0);
            $table->tinyInteger('watsapp')->default(0);
            $table->unsignedBigInteger('url_id')->nullable();
            $table->foreign('url_id')->references('id')->on('short_url');
            $table->json('ceremony_invite')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_ceramony', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ceramony_id')->constrained();
            $table->foreignId('user_id')->constrained();
            // $table->json('ceremony_invite')->nullable();
            $table->tinyInteger('invitationStatus')->default(0);
            $table->foreignId('invitation_id')->references('id')->on('invitations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_arrivals', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('specialRequest')->nullable();
            $table->string('location')->nullable();
            $table->string('travelMode')->nullable();
            $table->string('memberCount')->nullable();
            $table->string('transport')->default('car');
            $table->string('vehicleNo')->nullable();
            $table->string('driverName')->nullable();
            $table->string('driverMobile')->nullable();
            $table->string('inchargeName')->nullable();
            $table->string('inchargeMobile')->nullable();
            $table->string('inchargeLocation')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('slug')->nullable();
            $table->foreignId('guest_id')->references('id')->on('users');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('guest_departures', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('specialRequest')->nullable();
            $table->string('location')->nullable();
            $table->string('travelMode')->nullable();
            $table->string('memberCount')->nullable();
            $table->string('transport')->default('car');
            $table->string('vehicleNo')->nullable();
            $table->string('driverName')->nullable();
            $table->string('driverMobile')->nullable();
            $table->string('inchargeName')->nullable();
            $table->string('inchargeMobile')->nullable();
            $table->string('inchargeLocation')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('slug')->nullable();
            $table->foreignId('guest_id')->references('id')->on('users');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('guest_accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('hotelName')->nullable();
            $table->string('block')->nullable();
            $table->string('floor')->nullable();
            $table->string('roomno')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignId('guest_id')->references('id')->on('users');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
        });



        Schema::create('guest_privileges', function(Blueprint $table){
            $table->id();
            $table->string('hotelName')->nullable();
            $table->string('block')->nullable();
            $table->string('floor')->nullable();
            $table->string('roomno')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('attending')->default(false);
            $table->foreignId('family_id')->references('id')->on('guest_families')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        Schema::dropIfExists('guests');
        Schema::dropIfExists('guest_profiles');
        Schema::dropIfExists('guest_homes');
        Schema::dropIfExists('guest_offices');
        Schema::dropIfExists('guest_families');
        Schema::dropIfExists('guest_invitation');
        Schema::dropIfExists('guest_ceramony');
        Schema::dropIfExists('guest_arrivals');
        Schema::dropIfExists('guest_departures');
        Schema::dropIfExists('guest_accommodations');
        Schema::dropIfExists('guest_privileges');
        Schema::dropIfExists('short_url');
    }
}
