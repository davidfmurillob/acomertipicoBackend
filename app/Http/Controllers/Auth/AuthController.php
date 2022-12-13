<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller

{
    //registro de usuarios
    public function register(RegisterRequest $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol_id = $request->rol_id;
        $user->save();
        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status'=>200,
                'username'=>$user->name,
                "message" => "usuario creado",
                "token" =>$request->user()->createToken($request->email)->plainTextToken,
            ]);
        }
    }

    //login de usuarios
    public function login(LoginRequest  $request){

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                "message" => "Datos incorrectos",
                "success" => false
            ],200 );
        }

       //$user = User::where('rol_id', '=' , 1)->get();


        $userToken = Token::where('name', $request->email)->first();
        $user = User::where('email', $request->email)->first();
        if($userToken){
            $userToken->delete();
        }

        return response()->json([
            'id' => $user->id,
            'name' => $request->name,
            'status'=>200,
            "success" => true,
            "message" => 'Inicio de sesión exitoso',
            "rol_id" => $user->rol_id,
            "token" => $request->user()->createToken($request->email)->plainTextToken,
        ], 200);
    }

    //logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status'=>200,
            "message" => 'Has cerrado sesión',
        ], 410);
    }
}
