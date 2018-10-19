<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    protected $fillable = [
    	    'hosting',
            'plan',
            'url_cpanel',
            'user',
            'pass',
            'cuenta',
            'pin'];

     
    public function clientes(){
    	return  $this->belongsTo(Cliente::class);
    }
    public function host(){
    	return  $this->belongsTo(Host::class);
    }
    public function db(){
    	return  $this->belongsTo(Db::class);
    }
}
