<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudTrabajo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'tanque',
        'otros',
        'fecha',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
        'km_actual',
        'proximo_cambio',
        'pago',
        'detalle_pago',
        'mecanico_id',
        'estado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];


    
}
