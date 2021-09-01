<?php

namespace App\Http\Controllers;

use App\comentarios;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class comentariosController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $comentarios = comentarios::all();
        return $comentarios;
    }

    public function create(Request $request){
        try{
            $comentarios = comentarios::create([
                'id_user' => $request->get('id_user'),
                'id_video' => $request->get('id_video'),
                'calificacion' => $request->get('calificacion'),
                'mensaje' => $request->get('mensaje'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','comentario'=>$comentarios]);

        }catch (\Exception $e) {

            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    public function update(){

    }

    public function delete(){
    
    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getByUser($id){
        $comentarios = comentarios::where('id_user', $id)-> get();
        return response()->json($comentarios);
    }

    public function getByVideo($id){
        $comentarios = comentarios::where('id_video', $id)-> get();
        return response()->json($comentarios);
    }

}
