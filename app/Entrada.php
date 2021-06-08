<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;


class Entrada extends Model
{
    protected $table = 'entrada';
    protected $primaryKey = 'id_entrada';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $fillable = [
        'titulo', 'texto', 'etiquetas', 'id_usuario',
    ];

    public function comentarioEntrada(){
        return $this->hasMany(ComentarioEntrada::class,'id_entrada');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function valorEntrada(){
        return $this->hasMany(ValorEntrada::class, 'id_entrada');
    }
    public function getMediaAttribute(){
        $suma = 0;
        if(count($this->valorEntrada()->get())<1) {
            return 0;
        }else {
            foreach ($this->valorEntrada()->get() as $valor) {
                $suma += $valor->valor;
            }
            return $suma / count($this->valorEntrada()->get());
        }
    }

    public function votacion($id_user, $id_entrada){
        $vot = false;
        if(count($this->valorEntrada()->get())>0)
            foreach ($this->valorEntrada()->get() as $votaciones){
                if($votaciones->id_usuario == $id_user && $votaciones->id_entrada == $id_entrada){
                    return true;
                }
            }
        return $vot;
    }
}

