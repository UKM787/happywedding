<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{

   // protected $attributes = ["article1.png", "article2.png", "article3.png", "article4.png", "article5.png"];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('body');
            $table->text('excerpt')->nullable();
            $table->unsignedTinyInteger('priority')->default(1);
            $table->boolean('status')->default(false);
            $table->date('published_at')->default(now());
            $table->string('imageOne')->default('articleDefault.png');
            $table->json('imageGallery');
            $table->foreignId('category_id')->nullable()->constrained('categorymaster')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('likes')->default(30);
            $table->string('slug')->index()->nullable();
            $table->morphs('articable');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');;
            $table->foreignId('tag_id')->constrained('tags');
            $table->unique(['article_id', 'tag_id']);;
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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_tag');
    }
}
