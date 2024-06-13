<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //
    public function register(Request $request){
        try{
            $postData = $request->all();
            $validator = Validator::make($postData, [
                'password' => 'required',
                'email' => 'required',
                'name'=>'required',
            ]);

            if($validator->fails()){
                throw new \Exception("Invalid Request, all fields are mandatory");
            }

            $token = User::register($request);
            return response()->json(['token'=>$token],200);
        }catch(\Exception $ex){
            return response()->json(['error'=>$ex->getMessage()],400);
        }
    }

    public function login(Request $request){
        try{
            $postData = $request->all();
            $validator = Validator::make($postData, [
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()){
                throw new \Exception("Invalid User Credentials");
            }

            $token = User::login($request['email'],$request['password']);

            return response()->json(['token'=>$token],200);


        }catch(\Exception $ex){
            return response()->json(['error'=>$ex->getMessage()],400);
        }
    }

    public function logout(Request $request){
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message'=>'User logged out successfully'],200);


        }catch(\Exception $ex){
            return response()->json(['error'=>$ex->getMessage()],400);
        }

    }

    public function validateToken(Request $request){
        print_r($request->user()->email);
    }
}
