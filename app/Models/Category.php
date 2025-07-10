<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color'
    ];

    /**
     * Get the places associated with the category.
     */
    public function places()
    {
        return $this->hasMany(Place::class, 'id_category');
    }
}
