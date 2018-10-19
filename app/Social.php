<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['nombre','user','pass'];
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
}
