<?php

namespace App\Http\Controllers;

use App\filtro_instrumento;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class filtro_instrumentoController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $filtro_instrumento = filtro_instrumento::all();
        return $filtro_instrumento;
    }

    public function create(Request $request){

        try{
            $filtro_instrumento = filtro_instrumento::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','Filtro_instrumento'=>$filtro_instrumento]);
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }

    }

    public function update(Request $request){

    }

    public function delete($id){

        try{
            $filtro_instrumento = filtro_instrumento::where('id', $id)-> delete();
            return response()->json(['status' => '200', 'Message' => 'Filtro eliminado.']);
       
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }

    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $filtro_instrumento = filtro_instrumento::where('id', $id)-> get();
        return response()->json($filtro_instrumento);
    }

}
