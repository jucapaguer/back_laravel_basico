<?php

namespace App\Http\Controllers;

use App\categorias;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class categoriasController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $categorias = categorias::all();
        return $categorias;
    }

    public function create(Request $request){
        try{
            $categorias = categorias::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','categoria'=>$categorias]);
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
            return response()->json(['status' => '200', 'Message' => 'Categoria eliminada.']);
       
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    //------------PERSONALIZADAS---------------------------------------------------------

    public function getById($id){
        $categorias = categorias::where('id', $id)-> get();
        return response()->json($categorias);
    }

}
