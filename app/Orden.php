<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propietario',
        'telefono',
        'fecha',
        'vehiculo',
        'placa',
        'modelo',
        'color',
        'ano',
        'tanque',
        'solicitud',
        'tapa_ruedas',
        'llanta_auxilio',
        'gata_hidraulica',
        'llave_cruz',
        'pisos',
        'limpia_parabrisas',
        'tapa_tanque',
        'herramientas',
        'mangueras',
        'espejos',
        'tapa_cubos',
        'antena',
        'radio',
        'focos',
        'otros',
        'responsable',
        'fecha_ingreso',
        'fecha_salida',
        'km_actual',
        'proximo_cambio',
        'pago',
        'detalle_pago',
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
