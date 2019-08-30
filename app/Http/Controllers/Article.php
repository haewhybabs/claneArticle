<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ArticleModel;
use Illuminate\Support\Facades\Auth;

class Article extends Controller
{
    public function create(Request $request){

        $data=array(
            'status'=>false,
            'message'=>null,
        );

        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',
            'uploaded_by'=>'required'
        ]);

        if($validator->fails()){
            $data['message']=$validator->errors()->all();
            return response($data,200)->header('content-Type','application/json');
        }

        $article=array(
            'title'=>$request->input('title'),
            'body' =>$request->input('body'),
            'uploaded_by'=>$request->input('uploaded_by')
        );

        ArticleModel::insert($article);
        $data['message']='Article is successfully created';
        $data['status']='success';
        return response($data,200)->header('content-Type','application/json');




    }
}
