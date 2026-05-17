<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'artist', 'album_id', 'category_id', 
        'filename', 'mime_type', 'duration'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track')
                    ->withPivot('order');
    }
}
