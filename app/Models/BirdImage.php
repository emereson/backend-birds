<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_image', 
        'bird_id'
    ];

    public function birdsImgs()
    {
        return $this->hasMany(Bird::class, 'bird_id');
    }

}
