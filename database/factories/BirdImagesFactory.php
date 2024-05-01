<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'bird_id',
        'link_image',
    ];

    /**
     * Get the bird that owns the image.
     */
    public function bird()
    {
        return $this->belongsTo(Bird::class);
    }
}

