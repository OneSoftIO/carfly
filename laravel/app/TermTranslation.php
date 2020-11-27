<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'terms_translation';
    protected $fillable = [
        'meta_name',
        'meta_description',
        'meta_keywords',
        'name',
        'slug',
        'lang',
        'term_id'
    ];

}
