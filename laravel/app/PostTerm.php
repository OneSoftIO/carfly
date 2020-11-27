<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTerm extends Model
{
    public $timestamps = false;
    protected $table = 'post_terms';


    public function scopeOfPostId($query, $id){
        return $query->where('post_id', $id);
    }

}
