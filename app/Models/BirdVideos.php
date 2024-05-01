<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdVideos extends Model
{
    use HasFactory;
    protected $fillable = [
        'link_video', 
        'bird_id'
    ];

    public function birdVideos()
    {
        return $this->hasMany(Bird::class, 'bird_id');
    }
}
