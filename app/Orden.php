<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    
    use SoftDeletes;
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
        'fecha_salida',
        'hora_salida',
        'mecanico_id',
        'km_actual',
        'proximo_cambio',
        'pago',
        'detalle_pago',
        'estado',
        // cliente information
        'propietario',
        'telefono',
        'encargado',
        'telefono_encargado',
        // vehiculo information
        'vehiculo',
        'placa',
        'modelo',
        'color',
        'ano',
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
    public function mecanico()
    {
        return $this->belongsTo('App\Mecanico');
    }

    /**
     * Get the repuestos
     */
    public function repuestos()
    {
        return $this->hasMany('App\DetalleRepuesto', 'orden_id', 'id');
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

    public function getTotalRepuestos(){
        $total = 0;
        foreach ($this->repuestos as $key => $repuesto) {
            $total += $repuesto->precio;
        }
        return $total;
    }

    public function getTotalManoObra(){
        $total = 0;
        foreach ($this->detalleManoObra as $key => $detalle) {
            $total += $detalle->precio;
        }
        return $total;
    }

    
}
