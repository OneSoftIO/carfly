<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class BookingServices extends Model
{

    protected $table = 'booking__services';
    protected $fillable = ['order_id, service_id', 'amount'];

    public $timestamps = false;

    public function isFree(){
        return $this->service->price == 0.00;
    }
    public function translation(){
    	$service = $this->service;
    	if(empty($service)){
    		return null;
    	}

        $id = $service->id;
        $trans = VehiclesTermTranslation::where('term_id', $id)->where('lang', Lang::locale())->first();
        $primaryTrans = VehiclesTermTranslation::where('term_id', $id)->where('lang', 'lt')->first();
        return !empty($trans)?$trans:$primaryTrans;

    }
    public function service(){
        return $this->hasOne('App\VehiclesTerm', 'id', 'service_id');
    }

    public function primaryLang(){
        $id = $this->service->id;

        return $trans = VehiclesTermTranslation::where('term_id', $id)->where('lang', 'lt')->first();
    }


}


