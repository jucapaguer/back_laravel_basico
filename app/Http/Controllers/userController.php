<?php

namespace App\Http\Controllers;

use App\User;
use App\user_instrumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class userController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user($token);

        //return response()->json(compact('token'));
        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'telefono1' => 'required|max:10',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // validacion existencia de email
        $exist=User::where('email',$request->get('email'))->count();
        if ($exist) return response(['status'=>false,'message'=>__('mail_in_use'),'user'=>[]], 400);
    

        $user = User::create([
            'id_rol' => $request->get('id_rol'), 
            'id_plan' => $request->get('id_plan'),
            'nombre' => $request->get('nombre'), 
            'apellido' => $request->get('apellido'),
            'tipo_identificacion' => $request->get('tipo_identificacion'), 
            'numero_identificacion' => $request->get('numero_identificacion'), 
            'telefono1' => $request->get('telefono1'), 
            'telefono2' => $request->get('telefono2'), 
            'direccion1' => $request->get('direccion1'),
            'direccion2' => $request->get('direccion2'), 
            'congregacion' => $request->get('congregacion'), 
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token, 'user' => $user],200);
    }

    public function change_password(Request $request, $id) {

        $validator = Validator::make($request->all(), [
          'current_password' => 'required|string|min:6',
          'new_password' => 'required|string|min:6'
        ]);
        if ($validator->fails()) return response()->json($validator->messages(), 400);
  
        $user = User::find($id);
        $hashedPassword = $user->password;
  
        // Validacion clave anterior
        if (Hash::check( $request->get('current_password'), $hashedPassword)){
          // Cambiar clave
          $user = User::find($user->id);
          $user->password = Hash::make($request->get('new_password'));
          $user->save();
          return response()->json(['status'=>true,'message'=>__('Contraseña actualizada correctamente')]);
        }else{
          return response()->json(['status'=>false,'message'=>__('current_password_not_correct')], 422);
        }
    }

   /*  public function change_password(Request $request, $id) {

        $validator = Validator::make($request->all(), [
          'current_password' => 'required|string|min:6',
          'new_password' => 'required|string|min:6'
        ]);
        if ($validator->fails()) return response()->json($validator->messages(), 400);
  
        $user = User::find($id);
        $hashedPassword = $user->password;
  
        // Validacion clave anterior
        if (Hash::check( $request->get('current_password'), $hashedPassword)){
          // Cambiar clave
          $user = User::find($user->id);
          $user->password = Hash::make($request->get('new_password'));
          $user->save();
          return response()->json(['status'=>true,'message'=>__('Contraseña actualizada correctamente')]);
        }else{
          return response()->json(['status'=>false,'message'=>__('current_password_not_correct')], 422);
        }
    } */

    public function change_password2(Request $request, $id) {

        try{
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return response()->json(['status'=>true,'message'=>__('Contraseña actualizada correctamente')]);
        }catch(\Exception $e){

            DB::rollback();
            $message = $e->getMessage();
            return response()->json(['success'=> false, 'error'=> $message], 500);
        }

    }

    public function update(Request $request, $id){
        // Validation data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'tipo_identificacion' => 'required|string', 
            'numero_identificacion' => 'required|string',
            'telefono1' => 'required|string|min:10',
            'congregacion' => 'required|string',
            'direccion1' => 'required|string',
        ]);

       if ($validator->fails()) return response()->json($validator->messages(), 400);
       // Update
       
       $exist=User::where('id',$id)->count();
       if (! $exist) return response(['status'=>false,'message'=>__('no se encontro el usuario'),'user'=>[]], 400);
   
        $user = User::find($id);
        $user-> id_rol = $request->get('id_rol');
        $user-> id_plan = $request->get('id_plan');
        $user-> nombre = $request->get('nombre');
        $user-> apellido = $request->get('apellido');
        $user-> tipo_identificacion = $request->get('tipo_identificacion');
        $user-> numero_identificacion = $request->get('numero_identificacion');
        $user-> telefono1 = $request->get('telefono1');
        $user-> telefono2 = $request->get('telefono2');
        $user-> direccion1 = $request->get('direccion1');
        $user-> direccion2 = $request->get('direccion2');
        $user-> congregacion = $request->get('congregacion');
        $user-> instrumentos = $request->get('instrumentos');
        $user-> email = $request->get('email');
        $user->save();

       return response()->json(['status'=>true,'message'=>'datos actualizados correctamente'], 200);
    }

    //-----------------Personalizadas-------------------------------------------------------------------

    public function getByEmailDocument(Request $request){
        $user = user::where('numero_identificacion', $request -> email_doc)->orwhere('email', $request -> email_doc)-> get();
        return response()->json($user);
    }
}
