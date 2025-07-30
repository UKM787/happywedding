<?php

namespace App\Models\Admin;

use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use App\Models\Admin\CategoryMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Article extends Model
{
    use HasFactory;

    const EXCERPT_LENGTH = 100;

    protected $fillable = ['title', 'body', 'excerpt', 'priority', 'status', 'published_at', 'imageOne', 'imageGallery', 'category_id', 'slug', 'admin_id'];


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $attributes = [
        'imageGallery' => '["article1.png", "article2.png", "article3.png", "article4.png", "article5.png"]',
    ];
    protected $casts = [
        'imageGallery' => 'array'
    ];
    /**
     *An article is owned by an user.
     *
     *returns \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function getTitleAttribute($value)
    {
        return ucFirst($value);
    }

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = strtolower($value);
    }

    public function articable()
    {
        return $this->morphTo();
    }


    public function category()
    {
        return $this->belongsTo(CategoryMaster::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('id');
    }

    public function excerpt()
    {
        return Str::limit($this->body, Article::EXCERPT_LENGTH);
    }

    public function path()
    {
        return route('adminarticles.show', $this);
    }
}
