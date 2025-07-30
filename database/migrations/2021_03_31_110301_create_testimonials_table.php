<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('stars')->default(5);
            $table->text('body')->nullable();
            $table->text('excerpt')->nullable();
            $table->unsignedTinyInteger('priority')->default(1);
            $table->boolean('status')->default(false);
            $table->timestamp('published_at')->default(now());
            $table->string('imageOne')->default('articleDefault.png');
            $table->string('slug')->index()->nullable();
            $table->morphs('testimoniable');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tag_testimonial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')->constrained('testimonials')->onDelete('cascade');;
            $table->foreignId('tag_id')->constrained('tags');
            $table->unique(['testimonial_id', 'tag_id']);;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('tag_testimonial');
    }
}
