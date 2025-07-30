<?php

namespace App\Models\Admin;

use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    const EXCERPT_LENGTH = 100;

    protected $fillable = ['title', 'body', 'excerpt', 'priority', 'status', 'published_at', 'imageOne', 'slug'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTitleAttribute($value)
    {
        return ucFirst($value);
    }

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = strtolower($value);
    }

    public function testimoniable()
    {
        return $this->morphTo();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('id');
    }

    public function path()
    {
        return route('admin.testimonial.show', $this);
    }

    public function excerpt()
    {
        return Str::limit($this->body, Article::EXCERPT_LENGTH);
    }
}
