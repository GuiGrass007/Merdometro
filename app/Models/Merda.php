<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merda extends Model
{
    protected $fillable = ['user_id', 'titulo', 'descricao', 'nivel_estresse'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function votos(){
        return $this->hasMany(Voto::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
