<?php

use App\Models\Admin\TaskMaster;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('status')->default(true);
            $table->tinyInteger('priority')->default(0);
            $table->string('icon');
            $table->string('imageOne')->default('/venues/venueDefault.png');
            $table->string('slug');
            $table->foreignId('taskmaster_id')->references('id')->on('taskmaster')->default(1);
            $table->foreignId('admin_id')->references('id')->on('admins')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('memberstask', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('taskPriority');
            $table->string('taskStatus')->default('notStarted');
            $table->date('startDate');
            $table->date('completionDate');
            $table->time('startTime');
            $table->time('completionTime');
            $table->boolean('pinned')->default(false);
            //$table->foreignId('member_id')->references('id')->on('hosts');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('memberstask');
            $table->morphs('assignable');
            $table->foreignId('category_id')->references('id')->on('taskmaster');
            $table->foreignId('invitation_id')->references('id')->on('invitations');
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
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('member_tasks');
    }
}
