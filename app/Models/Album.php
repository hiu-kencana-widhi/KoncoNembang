<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'cover_image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
