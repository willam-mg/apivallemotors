<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    const TYPE_ADMIN = 1;
    const TYPE_MECANICO = 2;

    use HasApiTokens, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * the appends attributes for accesors.
     */
    protected $appends = [
        'foto', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    
    /**
     * Get the phone record associated with the user.
     */
    public function mecanico()
    {
        return $this->hasOne('App\Mecanico');
    }
    
    /**
     * Get the phone record associated with the user.
     */
    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function getFotoAttribute(){
        if ($this->admin){
            if ($this->admin->foto){
                return url('/').'/uploads/' . $this->admin->foto;
            }
        }
        if ($this->mecanico){
            if ($this->mecanico->src_foto){
                return $this->mecanico->foto;
            }
        }
        return null;
    }

    /**
     * Get the codigos
     */
    public function codigos()
    {
        return $this->hasMany('App\Codigo', 'user_id', 'id');
    }

    public function adminsPlayers(){
        return Admin::where('player_id', '<>', '')->get()->map(function($admin){
            return $admin->player_id;
        });
    }
}
