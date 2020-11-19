<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
      'name','cie10', 'estado',
      'created_id', 'created_at',
      'updated_id', 'updated_at'];

    public function user_created()
    {
        return $this->belongsTo('App\User', 'created_id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\User', 'updated_id');
    }
}
