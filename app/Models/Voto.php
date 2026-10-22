<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $fillable = ['user_id', 'merda_id', 'pontos', 'mudou_voto'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function merda(){
        return $this->belongsTo(Merda::class);
    }
}
