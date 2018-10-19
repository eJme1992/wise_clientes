<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	//Que campos puedo actualizar
    protected $fillable = ['nombre','nombre','logo','descripcion','tipo','correo','telefono'];

    // Me permite usar una clave primaria diferente al id para las busquedas
    public function usuarios(){
    	return  $this->hasMany(Usuario::class);
    }
     public function hosts(){
        return  $this->hasMany(Host::class);
    }
     public function mails(){
        return  $this->hasMany(Mail::class);
    }
     public function dbs(){
        return  $this->hasMany(Db::class);
    }
     public function sociales(){
        return  $this->hasMany(Social::class);
    }

     public function getRouteKeyName(){
        return 'slug';
    }

    public function limpiarCaracteresEspeciales($string ){
    $string = htmlentities($string);
    $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
    return $string;
    }

}
