<?php

namespace App\Http\Controllers;

use App\terminos;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class terminosController extends Controller
{
   //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $terminos = terminos::all();
        return $terminos;
    }

    public function create(Request $request){

    }

    public function update(Request $request){

    }

    public function delete($id){

    }

}
