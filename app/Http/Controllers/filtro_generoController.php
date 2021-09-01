<?php

namespace App\Http\Controllers;

use App\filtro_genero;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class filtro_generoController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $filtro_genero = filtro_genero::all();
        return $filtro_genero;
    }

    public function create(Request $request){

        try{
            $filtro_genero = filtro_genero::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','Filtro_genero'=>$categorias]);
        
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

            $filtro_genero = filtro_genero::where('id', $id)-> delete();
            return response()->json(['status' => '200', 'Message' => 'Filtro eliminado.']);
       
        }catch (\Exception $e) {

            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $filtro_genero = filtro_genero::where('id', $id)-> get();
        return response()->json($filtro_genero);
    }

}
