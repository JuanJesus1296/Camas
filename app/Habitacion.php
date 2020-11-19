<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';

    protected $fillable = [
        'piso_id','estado_id','habitacion', 'created_id','created_at', 'updated_id','updated_at'];

    public function piso()
    {
        return $this->belongsTo('App\Piso');
    }

    public function hospitalizacion(){
        return $this->hasMany('App\Hospitalizacion');
    }

    public function estado(){
        return $this->belongsTo('App\Estado');
    }

    public function userCrea(){
        return $this->belongsTo('App\User', 'created_id');
      }
    
      public function userUpd(){
        return $this->belongsTo('App\User', 'updated_id');
      }
}
