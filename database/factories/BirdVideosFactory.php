<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bird_id',
        'link_video',
    ];

    /**
     * Get the bird that owns the video.
     */
    public function bird()
    {
        return $this->belongsTo(Bird::class);
    }
}
