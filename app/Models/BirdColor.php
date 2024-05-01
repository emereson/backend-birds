<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code_color'
    ];
    
}
