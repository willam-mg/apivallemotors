<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleRepuesto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'solicitud_trabajo_id',
        'orden_id',
        'repuesto_id',
        'precio',
        'fecha',
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
     * Get the user.
     */
    public function repuesto()
    {
        return $this->belongsTo('App\repuesto');
    }
    
    /**
     * Get the user.
     */
    public function orden()
    {
        return $this->belongsTo('App\Orden');
    }
}
