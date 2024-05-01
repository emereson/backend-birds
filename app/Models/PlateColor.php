<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'code_color',
    ];

    /**
     * Get the birds for the plate color.
     */
    public function birds()
    {
        return $this->hasMany(Bird::class);
    }
}
