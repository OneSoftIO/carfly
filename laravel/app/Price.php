<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model{
    protected $fillable = ['vehicle_id', 'from', 'to', 'price', 'discount'];
    public $timestamps = false;

    public function Vehicle(){
        return $this->hasOne('App\Vehicle', 'id', 'vehicle_id');
    }
    public function hasDiscount() :bool
    {
        return $this->discount == true;
    }

}
