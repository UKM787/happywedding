<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('contact_for');
            // $table->string('name');
            // $table->string('mobile');
            $table->string('slug');
            $table->foreignId('host_id')->references('id')->on('hosts')->nullable();
            //$table->foreignId('member_id')->references('id')->on('hosts')->nullable();
            $table->foreignId('invitation_id')->references('id')->on('invitations')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
