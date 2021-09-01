<?php

namespace App\Http\Controllers;

use App\notificaciones;
use Illuminate\Http\Request;

class notificacionesController extends Controller
{
     //------------CRUD--BASICO--------------------------------------------------
     public function list(){
        $notificaciones = notificaciones::all();
        return $notificaciones;
    }

    public function create(Request $request){

    }

    public function update(Request $request){

    }

    public function delete($id){

    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $notificaciones = notificaciones::where('id_user', $id)-> get();
        return response()->json($notificaciones);
    }
}
