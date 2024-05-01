<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bird extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_color_id',
        'plate_number',
        'sex',
        'father_bird_id',
        'mother_bird_id',
        'birthdate',
        'bird_color', 
        'crest_type',
        'line',
        'weight',
        'status',
        'origin',
        'observations',
        'in_care'
    ];

    // Resto del código del modelo...

    // Convierte el campo bird_color a JSON antes de guardar en la base de datos
    public function setBirdColorAttribute($value)
    {
        $this->attributes['bird_color'] = json_encode($value);
    }

    // Convierte el campo bird_color de JSON a array al acceder a él
    public function getBirdColorAttribute($value)
    {
        return json_decode($value, true);
    }

    public function plateColor()
    {
        return $this->belongsTo(PlateColor::class, 'plate_color_id');
    }
    public function birdImage()
    {
        return $this->hasMany(BirdImage::class, 'bird_id');
    }
    public function vaccine()
    {
        return $this->hasMany(Vaccine::class, 'bird_id');
    }
    public function birdVideos()
    {
        return $this->hasMany(BirdVideos::class, 'bird_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($bird) {
            $bird->birdImage()->delete();
            // Agrega aquí cualquier otra relación que también necesite eliminación en cascada
        });
    }

  
}
