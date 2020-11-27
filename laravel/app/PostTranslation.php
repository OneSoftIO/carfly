<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'posts_translation';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'post_title',
        'slug',
        'post_content',
        'post_short_content',
        'lang',
        'meta_name',
        'meta_description',
        'meta_keywords'
    ];

}
