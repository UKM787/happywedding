<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('city')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('parent_id')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('role')->default('blogger');
            $table->string('password');
            $table->string('slug')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('locationmaster', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->string('latitude');
            $table->string('longitude');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('locationDefault.png');
            $table->string('slug')->nullable();
            $table->string('path')->nullable();
            $table->string('relation')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->default(1)->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('locationmaster')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categorymaster', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->longText('description');
            $table->enum('type', ['service', 'product'])->default('service');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->date('published_at')->default(Carbon::now());
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('category.png');
            $table->string('slug');
            $table->string('path')->nullable();
            $table->string('relation')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categorymaster')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servicemaster', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('serviceDefault.png');
            $table->string('slug');
            $table->string('path')->nullable();
            $table->string('relation')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->foreign('parent_id')->references('id')->on('servicemaster')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('task_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('before_after')->default(0);
            $table->timestamps();
        });

        Schema::create('taskmaster', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->longText('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            //$table->tinyInteger('timeline')->default(30);
            $table->date('completionDate')->default(Carbon::now());
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->default('taskDefault.png');
            $table->string('slug');
            $table->string('path')->nullable();
            $table->string('relation')->nullable();
            $table->unsignedBigInteger('timeline_id')->nullable()->default(1);
            $table->foreign('timeline_id')->references('id')->on('task_timeline');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->foreign('parent_id')->references('id')->on('taskmaster')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ceramonymaster', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->enum('type', ['H', 'O'])->default('H');
            $table->boolean('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->json('imageOne')->defaults('ceramonyDefault.png');
            $table->string('slug');
            $table->string('file')->default('CardDefault');
            $table->string('path')->nullable();
            $table->string('relation')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->foreign('parent_id')->references('id')->on('ceramonymaster')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->string('icon')->default('<i class="material-icons">place</i>');
            $table->string('imageOne')->defaults('tagDefault.png');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('admin_id')->default(1);
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
        Schema::dropIfExists('admins');
        Schema::dropIfExists('locationmaster');
        Schema::dropIfExists('categorymaster');
        Schema::dropIfExists('servicemaster');
        Schema::dropIfExists('task_timeline');
        Schema::dropIfExists('taskmaster');
        Schema::dropIfExists('ceramonymaster');
        Schema::dropIfExists('tags');
    }
}
