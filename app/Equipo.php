<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'estado'];
        
    public function piso()
  {
      return $this->belongsTo('App\piso', 'piso_id');
  }

  public function habitacionInicio()
  {
      return $this->belongsTo('App\Habitacion', 'habitacioninicio_id');
  }

  public function habitacionFinal()
  {
      return $this->belongsTo('App\Habitacion', 'habitacionfin_id');
  }

  public function usuarioCrea()
  {
      return $this->belongsTo('App\User', 'created_id');
  }

  public function usuarioUpd()
  {
      return $this->belongsTo('App\User', 'updated_id');
  }
}
