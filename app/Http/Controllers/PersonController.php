<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    public function search(){
        $q = request()->query('q');
        $people = Person::where("document", "like", "%{$q}%")
                  ->orWhere("name","like","%{$q}%")
                  ->select(\DB::raw("CONCAT(name,' ',lastname) as name, id"))->get();
      return $people;
    }

    public function show($person){
        $persona = Person::with('user')->where('id',$person)->first();
        return $persona;
    }
}
