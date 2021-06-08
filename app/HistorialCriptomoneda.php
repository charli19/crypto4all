<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialCriptomoneda extends Model
{
    protected $table = 'historial_criptomoneda';

    protected $fillable = [
        'id_criptomoneda','precio_dolar','fecha',
    ];




    public function criptomoneda(){
        return $this->belongsTo(Criptomoneda::class, 'id_criptomoneda');
    }
}
