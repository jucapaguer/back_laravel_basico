<?php

namespace App\Http\Controllers;

use App\rol;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class rolController extends Controller
{
    
  //------------CRUD--BASICO--------------------------------------------------
  public function list(){
      $rol = rol::all();
      return $rol;
  }

  public function create(Request $request){

  }

  public function update(Request $request){

  }

  public function delete($id){

  }

  //------------PERSONALIZADAS---------------------------------------------------------

  public function getById($id){
    $rol = rol::where('id', $id)-> get();
    return response()->json($rol);
  }

}
