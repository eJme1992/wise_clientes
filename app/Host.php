<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
   	protected $fillable = [
            'hosting',
            'plan',
            'url_cpanel',
            'user',
            'pass',
            'cuenta',
            'pin'
   	];

   	 
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
}
