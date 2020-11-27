<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    public $timestamps = false;
    protected $table = 'postmeta';

    public function scopeOfPostId($query, $id){
        return $query->where('post_id', $id);
    }
}
