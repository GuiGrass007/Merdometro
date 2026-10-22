<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['user_id', 'merda_id', 'texto'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function merda()
    {
        return $this->belongsTo(Merda::class);
    }
}
