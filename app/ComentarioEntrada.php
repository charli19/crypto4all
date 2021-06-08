<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioEntrada extends Model
{
    protected $table = 'comentario_entrada';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_comentario','id_entrada','id_usuario','comentario',
    ];

    public function entrada(){
        return $this->belongsTo(Entrada::class,'id_entrada');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'id_usuario');
    }
}
