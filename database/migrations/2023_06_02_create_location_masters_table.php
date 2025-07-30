<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_masters', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('state');
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('admin_id')->default(1);
            $table->string('imageOne')->default('locationDefault.png');
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
        Schema::dropIfExists('location_masters');
    }
}

