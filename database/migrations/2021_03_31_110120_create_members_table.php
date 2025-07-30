<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //    Schema::create('members', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->string('email')->unique();
    //         $table->string('mobile')->unique();
    //         $table->tinyInteger('status')->default(1);
    //         $table->integer('parent_id')->default(0);
    //         $table->string('slug')->nullable();
    //         $table->foreignId('host_id')->references('id')->on('hosts');
    //         $table->timestamps();
    //         $table->softDeletes();
    //     });
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('password')->nullable();
            $table->string('slug')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('member_invitation', function (Blueprint $table) {
            $table->id();
            $table->morphs('memberable');
            $table->foreignId('invitation_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('member_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('host_id')->nullable();
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->timestamps();
        });

        Schema::create('host_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained();
            $table->foreignId('member_id')->constrained();
            $table->foreignId('invitation_id')->constrained();
            $table->string('is_leader')->default('false');
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->foreign('leader_id')->references('id')->on('members');
            $table->unsignedBigInteger('departnment_id')->nullable();
            $table->foreign('departnment_id')->references('id')->on('member_departments');
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
        Schema::dropIfExists('members');
        Schema::dropIfExists('member_invitation');
        Schema::dropIfExists('host_member');
    }
}
