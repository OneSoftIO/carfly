<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiclesTranslation extends Model
{
    protected $table = 'vehicles_translation';
    public $timestamps = false;
    protected $fillable = ['vehicle_id', 'lang', 'description', 'information', 'meta_id'];
}
