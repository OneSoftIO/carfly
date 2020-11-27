<?php

namespace App;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;

class Vehicle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'status',
        'slug',
        'images',
        'resize_images',
        'terms',
        'car_year',
        'fuel_type',
        'gearbox',
        'run',
        'discount',
        'class'
    ];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'terms' => 'array',
        'images' => 'array',
        'resize_images' => 'array'
    ];

    public function ScopeGetActiveVehicles($query){
        return $query->with('trans')->where('status', true)->orderBy('ord', 'ASC');
    }
    public function info(){
        return $this->hasOne(VehiclesTranslation::class, 'vehicle_id');
    }
    public function trans(){
        return $this->info()->where('lang', Lang::locale());
    }
    public function scopeTranslate($query, $lang){
        return $query->with(['info' => function($query) use ($lang){
            $query->where('vehicles_translation.lang', $lang);
        }]);
    }
    public function price(){
        return $this->hasOne(Price::class)->orderby('price', 'ASC');
    }
    public function prices(){
        return $this->hasMany(Price::class)->orderby('from', 'ASC');
    }
    public function bookings(){
        return $this->hasMany('App\Booking', 'car_id');
    }
    public function PriceRange(){
        return $this->hasOne(Price::class);
    }
    public function ScopeDiscount($query){
        return $query->where('discount', true);
    }
    public function getPrice($request) :array
    {
        $days = Helper::finalDays($request);
        $arr = [];

        foreach ($this->prices as $item):
            if ($days >= $item->from && $days <= $item->to) {
                $price = $item->price;
                $arr['price'] = $item->price;
                $arr['discount'] = $item->discount ?: null;
            }
        endforeach;

        return $arr;
    }

    public function getCurrentOrder(){
        $ord = $this->ord;

        return --$ord;
    }

    public static function getClasses(){
        return (new \App\Library\Vehicle())->getVehiclesClasses();
    }
    public function getTermsAttr($car_id){
        return $this->where('id', $car_id)->first()->terms;
    }


}
