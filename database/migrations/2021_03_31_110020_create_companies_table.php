<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->foreignId('location_id')->constrained('locationmaster');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('priority')->default(0);
            //$table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('slug')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('company_pprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fathername');
            $table->string('mobile')->unique();
            $table->string('mobile1')->nullable();
            $table->string('landline')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('whatsapp1')->nullable();;
            $table->string('imageOne')->default('vendorDefault.png')->nullable();;
            $table->string('complex')->nullable();;
            $table->string('area');
            $table->string('district');
            $table->string('zipcode');
            $table->string('state');
            $table->string('country')->default('India');
            $table->string('slug');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('company_cprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('companyname');
            $table->mediumText('companyinfo');
            $table->mediumText('address');
            $table->string('map')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('establish')->nullable();
            $table->string('gst')->nullable();
            $table->string('phone')->unique();
            $table->string('mobile')->unique();
            $table->string('mobile1')->nullable();
            $table->string('whatsup');
            $table->string('imageOne')->default('vendorDefault.png');
            $table->string('slug');
            $table->foreignId('locationmaster_id')->references('id')->on('locationmaster');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->softDeletes();
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
        Schema::dropIfExists('companies');
    }
}
