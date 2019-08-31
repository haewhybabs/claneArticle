<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserAuthentication extends Controller
{
    public function register(Request $request){

        $data=array(
            'status'=>false,
            'message'=>null,
            'token'=>null
        );

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){
            $data['message']=$validator->errors()->all();
            return response($data,422)->header('content-Type','application/json');
        }

        $newUser=array(
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
        );

        //Check for exsting Email
        $existingEmail=User::where('email',$request->input('email'))->first();

        if($existingEmail){
            $data['message']='Email is already existing';
            return response($data,401)->header('content-Type','application/json');
        }
        else{
            $user=User::create($newUser);
            $data['token'] = $user->createToken('ClaneArticle')->accessToken;
            $data['status']='success';
            $data['message']='You have successfully registered';
            return response()->json($data, 200);

        }

    }

    public function login(Request $request){

        $data=array(
            'status'=>false,
            'message'=>null,
            'token'=>null,
        );

        $validator=Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){
            $data['message']=$validator->errors()->all();
            return response($data,422)->header('content-Type','application/json');
        }

        $user=array(
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        );

        if(Auth::attempt($user)){

            $data['status']='success';
            $data['message']='You have successfully logged in';
            $data['token'] =auth()->user()->createToken('ClaneArticle')->accessToken;
            return response()->json($data, 200);
        }
        else{

            $data['message']='Invalid password or email';
            return response($data,401)->header('content-Type','application/json');
        }


    }

    public function details(){
        return response()->json(['user' => auth()->user()], 200);
    }

    public function unAuthorized(){
        return response('Unauthorized',401)->header('content-Type','application/json');;
    }

}
