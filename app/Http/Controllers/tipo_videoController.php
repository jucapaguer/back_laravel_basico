<?php

namespace App\Http\Controllers;

use App\tipo_video;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class tipo_videoController extends Controller
{
   //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $tipo_video = tipo_video::all();
        return $tipo_video;
    }

    public function create(Request $request){

        try{
            $tipo_video = tipo_video::create([
                'nombre' => $request->get('nombre'),
            ]);
    
            return response()->json(['status'=>true,'message'=>'Ok','tipo_video'=>$tipo_video]);
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
            $tipo_video = tipo_video::where('id', $id)-> delete();
            return response()->json(['status' => '200', 'Message' => 'Filtro eliminada.']);
       
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

}
