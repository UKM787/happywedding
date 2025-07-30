<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_product', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->foreignId('product_id')->references('id')->on('categorymaster');
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
        Schema::dropIfExists('vendor_product');
    }
}
