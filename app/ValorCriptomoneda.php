<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorCriptomoneda extends Model
{
    protected $table = 'valor_criptomoneda';
    protected $primaryKey = 'id_valor';

    protected $fillable = [
        'id_valor','id_criptomoneda','id_usuario','valor',
    ];

    public function Criptomoneda(){
        return $this->belongsTo(Criptomoneda::class, 'id_criptomoneda');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
