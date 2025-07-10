<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_title',
        'event_content',
        'event_img_preview',
        'event_slug',
        'id_place',
        'id_user',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'id_place');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
