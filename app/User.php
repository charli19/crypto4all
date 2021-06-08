<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected  $table="users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick', 'nombre', 'apellidos', 'email', 'fecha_nacimiento', 'password', 'imagen', 'web', 'facebook' , 'instagram', 'twitter', 'google', 'linkedin',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    function comentarioCriptomoneda(){
        return $this->hasMany(ComentarioCriptomoneda::class, 'id_usuario');
    }

    function comentarioEntrada(){
        return $this->hasMany(ComentarioEntrada::class, 'id_usuario');
    }

    function criptomonedaFavorita(){
        return $this->hasMany(CriptomonedaFavorita::class, 'id_usuario');
    }

    function valorCriptomoneda(){
        return $this->hasMany(ValorCriptomoneda::class, 'id_usuario');
    }

    function valorEntrada(){
        return $this->hasMany(ValorEntrada::class, 'id_usuario');
    }

    function Entrada(){
        return $this->hasMany(Entrada::class, 'id_usuario');
    }

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }


    function criptomoneda($id_criptomoneda){
        return Criptomoneda::find($id_criptomoneda)->nombre;

    }
}
