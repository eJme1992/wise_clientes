<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Db extends Model
{
   	protected $fillable = ['dominio','name','user','pass'];
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
}
