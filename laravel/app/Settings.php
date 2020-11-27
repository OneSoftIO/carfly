<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model{
    protected $fillable = [
        'id',
        'option_value',
        'option_name'
    ];
    protected $casts = [
        'option_value' => 'array'
    ];
    public $timestamps = false;

    public function isActive(){
        return $this->option_value == 1;
    }
}
