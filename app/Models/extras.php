<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio'
    ];

    public function viaje()
    {
        return $this->belongsTo(viaje::class);
    }
}
