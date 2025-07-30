<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->tinyInteger('priority')->nullable();
            $table->string('page_name')->nullable();
             $table->string('web_url')->nullable();
             $table->mediumText('challanges')->nullable();
             $table->mediumText('recommendation')->nullable();
             $table->string('assigned_to')->nullable();
             $table->string('reported_by')->nullable();
             $table->string('status')->nullable();
             $table->mediumText('remarks')->nullable();
             $table->string('slug')->nullable();
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
        Schema::dropIfExists('site_tasks');
    }
}
