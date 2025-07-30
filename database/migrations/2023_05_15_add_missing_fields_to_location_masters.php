<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Rename the class to make it unique
class AddMissingFieldsToLocationMastersUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_masters', function (Blueprint $table) {
            if (!Schema::hasColumn('location_masters', 'admin_id')) {
                $table->unsignedBigInteger('admin_id')->default(1)->after('status');
            }
            
            if (!Schema::hasColumn('location_masters', 'imageOne')) {
                $table->string('imageOne')->default('locationDefault.png')->after('admin_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_masters', function (Blueprint $table) {
            if (Schema::hasColumn('location_masters', 'admin_id')) {
                $table->dropColumn('admin_id');
            }
            
            if (Schema::hasColumn('location_masters', 'imageOne')) {
                $table->dropColumn('imageOne');
            }
        });
    }
}


