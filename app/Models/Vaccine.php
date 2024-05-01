<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'bird_id',
        'blister', 
        'pill', 
        'drops', 
        'internal_deworming', 
        'external_deworming', 
        'date', 
    ];

    public function bird()
    {
        return $this->hasMany(Bird::class, 'id');
    }
    
}
