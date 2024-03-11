<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];
    protected $table = 'photos';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_photo')->withTimestamps();
    }
}
