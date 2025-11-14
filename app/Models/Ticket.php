<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['servicio_id','numero','prioritario','estado','llamado_at','atendido_at','reintentos'];
    protected $casts = ['prioritario'=>'bool','llamado_at'=>'datetime','atendido_at'=>'datetime'];
    public function servicio(){ return $this->belongsTo(Servicio::class); }
    public function llamados(){ return $this->hasMany(\App\Models\Llamado::class); }
   public function puesto() { return $this->belongsTo(Puesto::class); }

}
