<?php

namespace App\Http\Controllers;

use App\filtro_artista;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class filtro_artistaController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $filtro_artista = filtro_artista::all();
        return $filtro_artista;
    }

    public function create(Request $request){

        try{
            $filtro_artista = filtro_artista::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','filtro_artista'=>$filtro_artista]);
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
            $filtro_artista = filtro_artista::where('id', $id)-> delete();
            return response()->json(['status' => '200', 'Message' => 'Filtro eliminado.']);
       
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $filtro_artista = filtro_artista::where('id', $id)-> get();
        return response()->json($filtro_artista);
    }

}
