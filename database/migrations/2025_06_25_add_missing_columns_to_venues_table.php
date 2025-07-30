<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venues', function (Blueprint $table) {
            // Add state_id column if it doesn't exist
            if (!Schema::hasColumn('venues', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('state');
                $table->foreign('state_id')->references('id')->on('locationmaster')->onDelete('set null');
            }
            
            // Add locationmaster_id column if it doesn't exist
            if (!Schema::hasColumn('venues', 'locationmaster_id')) {
                $table->unsignedBigInteger('locationmaster_id')->nullable()->after('location_id');
                $table->foreign('locationmaster_id')->references('id')->on('locationmaster')->onDelete('set null');
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
        Schema::table('venues', function (Blueprint $table) {
            // Drop foreign keys first
            if (Schema::hasColumn('venues', 'state_id')) {
                $table->dropForeign(['state_id']);
                $table->dropColumn('state_id');
            }
            
            if (Schema::hasColumn('venues', 'locationmaster_id')) {
                $table->dropForeign(['locationmaster_id']);
                $table->dropColumn('locationmaster_id');
            }
        });
    }
}
