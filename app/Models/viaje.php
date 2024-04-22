<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'hora',
        'fecha',
        'total_pagar',
        'desde',
        'hasta',
        'metodo_pago',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Definir la relación con la zona de partida
     public function zonaDesde()
     {
         return $this->belongsTo(zonas::class, 'desde');
     }
 
     // Definir la relación con la zona de destino
     public function zonaHasta()
     {
         return $this->belongsTo(zonas::class, 'hasta');
     }
}
