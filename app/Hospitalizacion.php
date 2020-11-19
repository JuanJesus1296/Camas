<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
    protected $table = 'hospitalizaciones';

    protected $fillable = [
      'oa','Estado','created_id','created_at','updated_id','updated_at','person_id','doctor_id',
        'habitacion_id', 'Estado_Anulacion','diagnostico_id','gradodependencia_id', 'observacion'];

      public function habitacion()
      {
          return $this->belongsTo('App\Habitacion');
      }

      public function paciente()
      {
          return $this->belongsTo('App\Person', 'person_id');
      }

      public function medico()
      {
          return $this->belongsTo('App\Doctor', 'doctor_id');
      }

      public function diagnostico()
      {
          return $this->belongsTo('App\Diagnostico', 'diagnostico_id');
      }
}
