<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class piso extends Model
{
  public function habitacion()
  {
      return $this->hasOne('App\Habitacion');
  }

  public function userCrea(){
    return $this->belongsTo('App\User', 'created_id');
  }

  public function userUpd(){
    return $this->belongsTo('App\User', 'updated_id');
  }
}
