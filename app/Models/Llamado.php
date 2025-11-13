<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Llamado extends Model
{
    protected $fillable = ['ticket_id','puesto_id','tipo'];
    public function puesto(){ return $this->belongsTo(\App\Models\Puesto::class); }
    public function ticket(){ return $this->belongsTo(\App\Models\Ticket::class); }
}
