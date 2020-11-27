<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiclesTermTranslation extends Model
{
    protected $table = 'vehicles_terms_translation';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'term_id',
        'lang',
        'name',
        'info'
    ];
}
