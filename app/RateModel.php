<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateModel extends Model
{
    protected $fillable = [

        'article_id', 'rating'
    ];

    protected $table= 'article_rating';
}
