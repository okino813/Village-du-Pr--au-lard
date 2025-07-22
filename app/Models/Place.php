<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Place extends Model
{
    protected $fillable = [
        'title',
        'content',
        'img_preview',
        'latitude',
        'longitude',
        'slug',
        "color",
        'id_category',
        'id_user',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'id_place');
    }
}
