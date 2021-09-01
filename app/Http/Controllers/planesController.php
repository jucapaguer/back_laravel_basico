<?php

namespace App\Http\Controllers;

use App\planes;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class planesController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $planes = planes::all();
        return $planes;
    }

    public function create(Request $request){

    }

    public function update(Request $request){

    }

    public function delete($id){

    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $planes = planes::where('id', $id)-> get();
        return response()->json($planes);
    }

}
