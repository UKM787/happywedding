<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('side');
            $table->string('brideName');
            $table->string('brideMotherName');
            $table->string('brideFatherName');
            $table->string('brideEmail')->nullable();
            $table->string('brideMobile')->nullable();
            $table->string('groomName');
            $table->string('groomMotherName');
            $table->string('groomFatherName');
            $table->string('groomEmail')->nullable();
            $table->string('groomMobile')->nullable();
            //$table->string('state')->nullable();
            $table->dateTime('startDate');
            // $table->dateTime('endDate');
            $table->string('imageOne')->default('invitations/invitationDefault.png');
            $table->string('slug');
            $table->foreignId('host_id')->references('id')->on('hosts');
            $table->foreignId('location_id')->references('id')->on('locationmaster');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ceramonies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('menDress')->nullable();
            $table->string('ladiesDress')->nullable();
            $table->string('imageOne')->default('/assets/defaults/ceramonies/images/ceramonyDefault.png');
            $table->date('startDate');
            $table->time('startTime');
            $table->string('imageTwo')->nullable();
            $table->string('imageThree')->nullable();;
            $table->string('slug');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->foreignId('ceremony_id')->references('id')->on('ceramonymaster');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('savedate', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startDate');
            $table->boolean('counter')->default(false);
            $table->string('imageOne')->default('savedate/savedateDefault.png');
            $table->string('slug');
            $table->foreignId('invitation_id')->references('id')->on('invitations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('story', function (Blueprint $table) {
            $table->id();
            $table->string('groom_image')->default('story/Ellipse78.jpg');
            $table->mediumText('groom_desc');
            $table->string('bride_image')->default('story/Ellipse77.jpg');
            $table->mediumText('bride_desc');
            $table->string('first_meet_image')->default('story/Rectangle197.png');
            $table->mediumText('first_meet')->nullable();
            $table->date('first_meet_date')->nullable();
            $table->string('relation_start_image')->default('story/Rectangle198.png');
            $table->mediumText('relation_start')->nullable();
            $table->date('relation_start_date')->nullable();
            $table->string('marriage_decide_image')->default('story/Rectangle199.png');
            $table->mediumText('marriage_decide')->nullable();
            $table->date('marriage_decide_date')->nullable();
            $table->longText('images')->nullable();
            $table->string('slug');
            $table->foreignId('invitation_id')->references('id')->on('invitations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_venue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->foreignId('venue_id')->references('id')->on('venues');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('task_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        }); 

        Schema::create('invitation_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->foreignId('task_id')->references('id')->on('taskmaster');
            $table->unsignedBigInteger('custom_timeline_id')->nullable();
            $table->foreign('custom_timeline_id')->references('id')->on('task_timeline');
            $table->tinyInteger('taskStatus')->default(0);
            $table->tinyInteger('timeline')->default(60);
            $table->date('started_date')->nullable();
            $table->date('complete_date')->nullable();
            $table->unique(['invitation_id', 'task_id']);
            $table->nullableMorphs('completeable');
            $table->nullableMorphs('assignable');
            $table->timestamps();
        });

        Schema::create('vendorables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->string('title');
            $table->morphs('vendorable');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ceramony_venue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ceramony_id')->references('id')->on('ceramonies')->onDelete('cascade');
            $table->foreignId('venue_id')->references('id')->on('venues');
            $table->foreignId('invitation_id')->reference('id')->on('invitations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('coverimage');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('imageName');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->foreignId('album_id')->references('id')->on('albums');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
            $table->timestamps();
        });

        Schema::create('host_accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('block')->nullable();
            $table->json('floor')->nullable();
            $table->unsignedBigInteger('invitation_id');
            $table->foreign('invitation_id')->references('id')->on('invitations')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('accomm_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('accommodation_id');
            $table->foreign('accommodation_id')->references('id')->on('host_accommodations')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('accomm_floors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('block_id');
            $table->foreign('block_id')->references('id')->on('accomm_blocks')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('accomm_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room');
            $table->string('members');

            $table->unsignedBigInteger('floor_id');
            $table->foreign('floor_id')->references('id')->on('accomm_floors')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
        Schema::dropIfExists('savedate');
        Schema::dropIfExists('story');
        Schema::dropIfExists('ceramonies');
        Schema::dropIfExists('invitation_venue');
        Schema::dropIfExists('ceramony_venue');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('host_accommodations');
        Schema::dropIfExists('accomm_blocks');
        Schema::dropIfExists('accomm_floors');
        Schema::dropIfExists('accomm_rooms');
    }
}
