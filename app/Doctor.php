<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  public function person()
  {
      return $this->belongsTo('App\Person', 'person_id');
  }

  public function especialidad(){
    return $this->belongsTo('App\Especialidad', 'especialidad_id');
  }

  public function userCrea(){
    return $this->belongsTo('App\User', 'created_id');
  }

  public function userUpd(){
    return $this->belongsTo('App\User', 'updated_id');
  }
}
