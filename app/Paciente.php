<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo',
        'direccion',
        'ciudad',
        'celular',
        'src_foto',
        'player_id',
        'user_id',
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
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

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
     * Get the recetas
     */
    public function recetas()
    {
        return $this->hasMany('App\Receta', 'paciente_id', 'id');
    }
    
    /**
     * Get the recetas
     */
    public function citas()
    {
        return $this->hasMany('App\Cita', 'paciente_id', 'id');
    }
    
    /**
     * Get the recetas
     */
    public function compras()
    {
        return $this->hasMany('App\Compra', 'paciente_id', 'id');
    }
}
