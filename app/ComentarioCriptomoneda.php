<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioCriptomoneda extends Model
{
    protected $table = 'comentario_criptomoneda';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_comentario','id_criptomoneda','id_usuario','comentario',
    ];

    public function criptomoneda(){
        return $this->belongsTo(Criptomoneda::class, 'id_criptomoneda');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}