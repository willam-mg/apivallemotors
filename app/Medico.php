<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
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
        'user_id',
        'celular',
        'src_foto',
        'src_matricula',
        'player_id',
        'descripcion',
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
        'matricula'
    ];

    /**
     * Get the user.
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
     * Get accesor matricula attribute.
     */
    public function getMatriculaAttribute(){
        if ($this->src_matricula){
            return url('/').'/uploads/' . $this->src_matricula;
        }
        return null;
    }

    /**
     * Get the recetas
     */
    public function recetas()
    {
        return $this->hasMany('App\Receta', 'medico_id', 'id');
    }
    
    /**
     * Get the recetas
     */
    public function citas()
    {
        return $this->hasMany('App\Cita', 'medico_id', 'id');
    }
}
