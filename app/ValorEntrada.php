<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorEntrada extends Model
{
    protected $table = 'valor_entrada';
    protected $primaryKey = 'id_valor';

    protected $fillable = [
        'id_valor','id_entrada','id_usuario','valor',
    ];


    public function Entrada(){
        return $this->belongsTo(Entrada::class,'id_entrada');
    }

    public function User(){
        return $this->belongsTo(User::class,'id_usuario');
    }
}
