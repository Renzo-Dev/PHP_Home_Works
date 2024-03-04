<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'category_photo')->withTimestamps();
    }
}
