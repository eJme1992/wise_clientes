<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

	protected $fillable = ['nombre','apellido','cargo','tipo','correo','telefono'];
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
}
