<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mecanico extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo',
        'telefono',
        'direccion',
        'ci',
        'email',
        'especialidad',
        'fecha_ingreso',
        'fecha_salida',
        'src_foto',
        'user_id',
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
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
