<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoVehiculo extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orden_id',
        'accesorio_id',
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
     * the appends attributes for accesors.
     */
    protected $appends = [
        'mdaccesorio', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function getMdaccesorioAttribute()
    {
        return $this->accesorio;
    }
    
    /**
     * Get the model one.
     */
    public function accesorio()
    {
        return $this->belongsTo('App\Accesorio');
    }
}
