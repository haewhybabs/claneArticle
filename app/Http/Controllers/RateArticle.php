<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RateModel;
use Validator;
use Illuminate\Support\Facades\DB;

class RateArticle extends Controller
{
    public function rating(Request $request){

        $data=array(
            'status'=>false,
            'message'=>null,
        );

        $validator = Validator::make($request->all(),[
            'rating'=>'required',
            'article_id'=>'required'
        ]);

        if($validator->fails()){
            $data['message']=$validator->errors()->all();
            return response($data,422)->header('content-Type','application/json');
        }

        if($request->input('rating')>10 || $request->input('rating')< 1){
            $data['message']='Article Rating is between 1-10';
            return response($data,422)->header('content-Type','application/json');
        }

        $newRating=array(
            'article_id' =>$request->input('article_id'),
            'rating' =>$request->input('rating')
        );

        RateModel::create($newRating);

        return $this->cummulativeRating($newRating);

    }

    public function cummulativeRating($newRating){

        $AllRating=RateModel::where('article_id',$newRating['article_id'])->get();
        $rateCount = count($AllRating);

        $total=0;

        foreach($AllRating as $articleRating){
            $total=$total+$articleRating->rating;
        }

        $cummulativeRating=$total/$rateCount;

        //Update Article Table
        DB::table('article')->where('article_id',$newRating['article_id'])->update(['cummulative_rating'=>$cummulativeRating]);
        $data['status']='success';
        return response($data,200)->header('content-Type','application/json');
    }
}
