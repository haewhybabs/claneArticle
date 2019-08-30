<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    protected $fillable = [
        'title', 'body'
    ];

    protected $table= 'article';
}
