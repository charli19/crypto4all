<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriptomonedaFavorita extends Model
{
    protected $table = 'criptomoneda_favorita';
    public $timestamps = false;

    protected $fillable = [
        'id_criptomoneda','id_usuario',
    ];

    public function criptomoneda(){
        return $this->belongsTo(Criptomoneda::class, 'id_criptomoneda');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}