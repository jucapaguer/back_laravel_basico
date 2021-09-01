<?php

namespace App\Http\Controllers;

use App\favoritos;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class favoritosController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $favoritos = DB::select( DB::raw("SELECT * FROM `favoritos` WHERE `estado` = 1"));
        return $favoritos;
    }

    public function create(Request $request){

        try{
            $favoritos = favoritos::create([
                'id_user' => $request->get('id_user'),
                'id_video' => $request->get('id_video'),
                'estado' => $request->get('estado')
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','favoritos'=>$favoritos]);

        }catch (\Exception $e) {

            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
        
    }

    public function update(Request $request, $id){

        try{
            $favoritos = favoritos::find($id);
            $favoritos->estado = $request->get('estado');
            $favoritos->save();
    
            return response()->json(['status'=>true,'message'=>'Ok','favoritos'=>$favoritos]);

        }catch (\Exception $e) {

            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    public function delete(){

    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getByUser($id){
        $favoritos = favoritos::where('id_user', $id)-> get();
        return response()->json($favoritos);
    }

}
