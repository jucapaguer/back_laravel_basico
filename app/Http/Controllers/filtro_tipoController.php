<?php

namespace App\Http\Controllers;

use App\filtro_tipo;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class filtro_tipoController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $filtro_tipo = filtro_tipo::all();
        return $filtro_tipo;
    }

    public function create(Request $request){
        try{
            $filtro_tipo = filtro_tipo::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','Filtro_tipo'=>$filtro_tipo]);
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    public function update(){

    }

    public function delete($id){
        try{
            $categorias = categorias::where('id', $id)-> delete();
            return response()->json(['status' => '200', 'Message' => 'Filtro eliminado.']);
       
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $filtro_tipo = filtro_tipo::where('id', $id)-> get();
        return response()->json($filtro_tipo);
    }

}
