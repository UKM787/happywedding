<?php

namespace App\Models\Admin;

use App\Models\Admin\Article;
use App\Models\Admin\Testimonial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'priority', 'slug', 'admin_id', 'imageOne'];


    public function articles()
    {
        return $this->belongsToMany(Article::class)->withTimestamps();
    }

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class)->withTimestamps();
    }
}
