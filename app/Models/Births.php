<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Births extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_eggs',
        'number_births',
        'father_id',
        'mother_id',
        'date_eggs',
        'date_hatching', 
    
    ];

    public function father()
    {
        return $this->belongsTo(Bird::class, 'father_id')->with('plateColor');
    }
    
    public function mother()
    {
        return $this->belongsTo(Bird::class, 'mother_id')->with('plateColor');
    }
    
    
}
