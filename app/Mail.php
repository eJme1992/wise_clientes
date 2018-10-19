<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
	protected $fillable = [ 
            'mail',
            'user',
            'pass'
	];
	  
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
}
