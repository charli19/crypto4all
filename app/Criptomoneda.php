<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Criptomoneda extends Model
{
    protected $table = 'criptomoneda';
    protected $primaryKey = 'id_criptomoneda';
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'id_criptomoneda', 'nombre', 'ranking' , 'volumen_24h', 'capital_mercado_dolar', 'total_circulacion' , 'porcentaje_1h' , 'porcentaje_24h' , 'porcentaje_7d' , 'precio',
    ];

    public function comentarioCriptomoneda(){
        return $this->hasMany(comentarioCriptomoneda::class, 'id_criptomoneda');
    }

    public function historialCriptomoneda(){
        return $this->hasMany(HistorialCriptomoneda::class, 'id_criptomoneda');
    }

    public function historialCompleto(){
        return $this->hasMany(HistorialCompleto::class, 'id_criptomoneda');
    }

    public function criptomonedaFavorita(){
        return $this->hasMany(CriptomonedaFavorita::class, 'id_criptomoneda');
    }

    public function valorCriptomoneda(){
        return $this->hasMany(ValorCriptomoneda::class, 'id_criptomoneda');
    }


    public function getMediaAttribute(){
        $suma = 0;
        if(count($this->valorCriptomoneda()->get())<1) {
            return 0;
        }else {
            foreach ($this->valorCriptomoneda()->get() as $valor) {
                $suma += $valor->valor;
            }
            return $suma / count($this->valorCriptomoneda()->get());
        }
    }


    public function votacion($id_user, $id_criptomoneda){
        $vot = false;
        if(count($this->valorCriptomoneda()->get())>0)
            foreach ($this->valorCriptomoneda()->get() as $votaciones){
                if($votaciones->id_usuario == $id_user && $votaciones->id_criptomoneda == $id_criptomoneda){
                    return true;
                }
            }
        return $vot;
    }

    public function fav($id_user, $id_criptomoneda){
        $fav = false;
        if(count($this->criptomonedaFavorita()->get())>0)
            foreach ($this->criptomonedaFavorita()->get() as $favorito){
                if($favorito->id_usuario == $id_user && $favorito->id_criptomoneda == $id_criptomoneda){
                    return true;
                }
            }
        return $fav;
    }
}