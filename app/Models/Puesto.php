<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $fillable = ['nombre','servicio_id','agente_id','activo'];
    public function servicio(){ return $this->belongsTo(Servicio::class); }
}
