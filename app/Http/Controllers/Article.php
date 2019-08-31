<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ArticleModel;
use Illuminate\Support\Facades\DB;
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
            return response($data,422)->header('content-Type','application/json');
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

    public function list(){

        $articles= DB::table('article')->join('users','users.id','=','article.uploaded_by')
        ->select('users.name','article.*')->paginate();

        return response()->json($articles, 200);

    }

    public function get($id){

        $article= DB::table('article')->join('users','users.id','=','article.uploaded_by')
        ->where('article.article_id',$id)
        ->select('users.name','article.*')->first();

        return response()->json($article, 200);
    }

    public function update(Request $request,$id){

        $data=array(
            'status'=>false,
            'message'=>null,
        );

        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',
        ]);

        if($validator->fails()){

            $data['message']=$validator->errors()->all();
            return response($data,422)->header('content-Type','application/json');
        }

        $article=array(
            'title'=>$request->input('title'),
            'body' =>$request->input('body'),
        );

        $updateData=ArticleModel::where('article_id',$id)->update($article);

        if(!$updateData){
            $data['message'] ='Article Not Found';
            return response($data,404)->header('content-Type','application/json');
        }
        else{
            $data['status']='success';
            return response($data,200)->header('content-Type','application/json');
        }

    }

    public function delete($id){

        $data=array(
            'status'=>false,
            'message'=>null,
        );

        if(ArticleModel::where('article_id',$id)->delete()){
            $data['status']='success';
            return response($data,200)->header('content-Type','application/json');
        }

        else{
            $data['message']='Article Not Found';
            return response($data,404)->header('content-Type','application/json');
        }

    }

    public function search(Request $request){

        $data=array('status'=>'false');

        $searchArticle = $request->input('search');
        $result=ArticleModel::where('title','like','%'.$searchArticle. '%')->orwhere('body','like','%'.$searchArticle. '%')->paginate();

        if($result){

            return response($result,200)->header('content-Type','application/json');
        }
        else{

            return response($data,404)->header('content-Type','application/json');
        }


    }
}
