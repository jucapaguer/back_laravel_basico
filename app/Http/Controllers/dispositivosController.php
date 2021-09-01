<?php

namespace App\Http\Controllers;

use App\dispositivos;
use App\notificaciones;
use Illuminate\Http\Request;

class dispositivosController extends Controller
{
    
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $dispositivos = dispositivos::all();
        return $dispositivos;
    }

    // insert new register of an status
    public function create(Request $request){

        $uui = $request->get('dispositivo');
        $id = dispositivos::where('uui_dispositivo', $uui)->get();
        //return $id;

        $exist = dispositivos::where('uui_dispositivo',$uui)->count();

        if($exist == 0){

            try{
                $dispositivos = dispositivos::create([
                    'id_user' => $request->get('id_user'),
                    'id_dispositivo' => $request->get('id_dispositivo'),
                    'uui_dispositivo' => $request->get('dispositivo'),
                    'sistema' => $request->get('sistema'),
                ]);
        
                return response()->json(['status'=>true,'message'=>'Ok','user'=>$dispositivos]);
            }catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return response()->json(['success'=> false, 'error'=> $message], 500);
            }

        }else{

            try{
                $dispositivos = dispositivos::find($id[0]['id']);
                $dispositivos->id_user = $request->get('id_user');
                $dispositivos->id_dispositivo = $request->get('id_dispositivo');
                $dispositivos->dispositivo = $request->get('uui_dispositivo');
                $dispositivos->sistema = $request->get('sistema');
                $dispositivos->save();
        
                return response()->json(['status'=>true,'message'=>'Ok','user'=>$dispositivos]);
            }catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return response()->json(['success'=> false, 'error'=> $message], 500);
            }
        }

       
    }

    // update register of the status
    public function update(Request $request, $id){
        try{
            $dispositivos = dispositivos::find($id);
            $dispositivos->id_user = $request->get('id_user');
            $dispositivos->id_dispositivo = $request->get('id_dispositivo');
            $dispositivos->dispositivo = $request->get('uui_dispositivo');
            $dispositivos->sistema = $request->get('sistema');
            $dispositivos->save();
    
            return response()->json(['status'=>true,'message'=>'Ok','user'=>$dispositivos]);
        }catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

    // delete register of the status
    public function delete($id){
        $dispositivos = dispositivos::where('id', $id) -> delete();
        return response()->json(['status' => '200', 'Message' => 'Status deleted Succesfully']);
    }

    public function getByIdUser($id){

        try{
            $dispositivos = dispositivos::where('id_user', $id)->get();
    
            return response()->json(['status'=>true,'message'=>'Ok','user'=>$dispositivos]);
        }catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
       
    }

    public function enviar( Request $request){

        $dispositivos = dispositivos::where('id_user', $request->get('id_user'))->get();
        $titulo = $request->get('titulo');
        $cuerpo = $request->get('body');
        $data = $request->get('data');;

        $usertokens = array();
        for ($i=0; $i < count($dispositivos); $i++) {

            $notificaciones = notificaciones::create([
                'id_user' => $request->get('id_user'),
                'nombre' => $request->get('titulo'),
                'descripcion' => $request->get('body'),
            ]);

            array_push($usertokens , $dispositivos[$i]->id_dispositivo);
        }

        try{
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder($titulo);
            $notificationBuilder->setBody($cuerpo)
            				    ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['data' => $data]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            // You must change it to get your tokens
            $tokens = $usertokens;

            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            return response()->json(['status'=>true,'message'=>'Ok']);
        }catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }
    }

}
