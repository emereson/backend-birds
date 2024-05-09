<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bird_fights extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_fight',
        'coliseum',
        'opponent',
        'weight',
        'date_fight',
        'minutes',
        'state',
        'bird_id', // Aquí debería ser la coma, no "fonenkey"
    ];

    // Relación con el modelo Bird
    public function bird()
    {
        return $this->belongsTo(Bird::class);
    }
}
