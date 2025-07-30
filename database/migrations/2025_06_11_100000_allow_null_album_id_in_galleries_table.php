<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// Rename the class to make it unique
class AllowNullAlbumIdInGalleriesTableWithForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, drop the foreign key constraint
        Schema::table('galleries', function (Blueprint $table) {
            // Get the constraint name
            $foreignKeys = DB::select(
                "SELECT CONSTRAINT_NAME
                FROM information_schema.TABLE_CONSTRAINTS
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'galleries'
                AND CONSTRAINT_TYPE = 'FOREIGN KEY'
                AND CONSTRAINT_NAME LIKE '%album_id%'"
            );

            if (!empty($foreignKeys)) {
                $foreignKeyName = $foreignKeys[0]->CONSTRAINT_NAME;
                $table->dropForeign($foreignKeyName);
            }
        });

        // Then modify the column to allow NULL
        DB::statement('ALTER TABLE galleries MODIFY album_id BIGINT UNSIGNED NULL');

        // Finally, add the foreign key constraint back, but with ON DELETE SET NULL
        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('album_id')
                  ->references('id')
                  ->on('albums')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // First, drop the foreign key constraint
        Schema::table('galleries', function (Blueprint $table) {
            // Get the constraint name
            $foreignKeys = DB::select(
                "SELECT CONSTRAINT_NAME
                FROM information_schema.TABLE_CONSTRAINTS
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'galleries'
                AND CONSTRAINT_TYPE = 'FOREIGN KEY'
                AND CONSTRAINT_NAME LIKE '%album_id%'"
            );

            if (!empty($foreignKeys)) {
                $foreignKeyName = $foreignKeys[0]->CONSTRAINT_NAME;
                $table->dropForeign($foreignKeyName);
            }
        });

        // Then modify the column to not allow NULL
        DB::statement('ALTER TABLE galleries MODIFY album_id BIGINT UNSIGNED NOT NULL');

        // Finally, add the foreign key constraint back
        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('album_id')
                  ->references('id')
                  ->on('albums');
        });
    }
}

