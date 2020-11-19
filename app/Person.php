<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

  protected $fillable = ['name','lastname','fullname','document','created_id','created_at','updated_id','updated_at'];

  public function user(){
    return $this->hasOne('App\User');
  }

  public function userCrea(){
    return $this->belongsTo('App\User', 'created_id');
  }

  public function userUpd(){
    return $this->belongsTo('App\User', 'updated_id');
  }

  public function doctor(){
    return $this->hasOne('App\Doctor');
  }
}
