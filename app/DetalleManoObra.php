<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleManoObra extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'solicitud_trabajo_id',
        'descripcion',
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
}
