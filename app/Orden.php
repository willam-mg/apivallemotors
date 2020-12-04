<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repuesto;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehiculo_id',
        'fecha',
        'solicitud',
        'tanque',
        'estado_vehiculo_otros',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
        'mecanico_id',
        'km_actual',
        'proximo_cambio',
        'pago',
        'detalle_pago',
        'estado',

        'propietario',
        'telefono',

        'vehiculo',
        'placa',
        'modelo',
        'color',
        'ano',

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
        'src_foto',
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

    /**
     * Get the vehiculo
     */
    public function vehiculo()
    {
        return $this->belongsTo('App\Vehiculo');
    }

    /**
     * Get the repuestos
     */
    public function repuestos()
    {
        return $this->hasMany('App\DetalleRepuesto', 'orden_id', 'id');
    }

    /**
     * Get the repuestos
     */
    public function getRepuestos()
    {
        $detalle = $this->repuestos;
        $res = [];
        foreach ($detalle as $key => $det) {
            array_push($res, [
                'id'=>$det->id,
                'repuesto_id'=>$det->repuesto_id,
                'repuesto'=>$det->repuesto,
                'nombre'=>$det->repuesto->nombre,
                'precio'=>$det->precio,
            ]);
        }
        return $res;

    }

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'foto', 
    ];

    /**
     * Get accesor foto attribute.
     */
    public function getFotoAttribute(){
        if ($this->src_foto){
            return url('/').'/uploads/' . $this->src_foto;
        }
        return null;
    }

    /**
     * Get the detalle mano de obra
     */
    public function detalleManoObra()
    {
        return $this->hasMany('App\DetalleManoObra', 'orden_id', 'id');
    }
    
    /**
     * Get the estadodel vehiculo
     */
    public function estadoVehiculo()
    {
        return $this->hasMany('App\EstadoVehiculo', 'orden_id', 'id');
    }

    
}
