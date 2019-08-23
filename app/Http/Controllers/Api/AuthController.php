<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function signup(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:6|confirmed',
        ]);

        // Me devuelve un boolean si ha fallado o no la validadicion
        if($validator->fails()){
            // Por defecto es 200 el status
            // return \response(['errors'=> $validator->errors()->all()], 422);
            return \response()->json(['errors'=> $validator->errors()->all()], 422);
        }

        // $user = new User([
        //     'name'=> $request->name,
        //     'email'=> $request->email,
        //     'password'=>Hash::make($request->password)
        // ]);

        // $user = new User($request->all());

        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);

        $user->save();

        return \response()->json(['message'=>'Successfuly created user!']);
    }

    public function login(Request $request){
    // El user existe?

        $user = \App\User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('Laravel User Client')->accessToken;
                return \response()->json(['token'=>$token],200);
            }else{
                return \response()->json(['error' => 'Password or Email missmatch'],422);
            }
        }
        return \response()->json(['error'=>'The user doesnt exist'],422);
    }
}
