<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityColumnToVenuesTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venues', function (Blueprint $table) {
            // Add city column if it doesn't exist
            if (!Schema::hasColumn('venues', 'city')) {
                $table->string('city')->nullable()->after('state');
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
            if (Schema::hasColumn('venues', 'city')) {
                $table->dropColumn('city');
            }
        });
    }
}
