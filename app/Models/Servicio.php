<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['codigo','nombre','tiempo_estimado_seg'];
    public function tickets(){ return $this->hasMany(Ticket::class); }
}
