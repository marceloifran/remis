<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class zonas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'zona',
        'precio'
    ];

    public function viaje()
    {
        return $this->belongsTo(viaje::class);
    }

   
}
