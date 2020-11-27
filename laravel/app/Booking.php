<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Library\Vehicle as Car;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle',
        'status',
        'from',
        'from_hour',
        'until',
        'until_hour',
        'user_id',
        'car_id',
        'from_timestamp',
        'until_timestamp',
        'pickup',
        'dropoff',
        'created_at',
        'privacy_policy',
        'info'
    ];

    public $timestamps = false;
    protected $dates = ['deleted_at', 'created_at'];

    public function Vehicles(){
        return $this->hasOne('App\Vehicle', 'id', 'car_id');
    }
    public function User(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function order(){
        return $this->hasOne('App\Order', 'booking_id', 'id');
    }
    public function status(){
        $status = $this->status;
        $library = new Car;

        foreach ($library->VehicleStatuses() as $key => $vehicleStatus){
            if($key == $status)
                return $vehicleStatus;
            else
                return "Undefined";
        }

    }
    public function isWaiting(){
        return $this->status === 'confirmation';
    }
    public function isConfirm():bool
    {
        return $this->status === 'approved';
    }
    public function isDisapproved(){
        return $this->status === 'disapproved';
    }
    public function fromTime(){
        $time = $this->from_timestamp;
        return date('G:i', $time);
    }
    public function untilTime(){
        $time = $this->until_timestamp;
        return date('G:i', $time);
    }

//    public function scopeSearchCar($query, $from, $until, $type){
//        $lib = new Car();
//        $status = array_keys($lib->VehicleStatuses());
//
//        if($type === 1):
//            $where = $query->where('from_timestamp', '<=', $from)
//                ->where('until_timestamp', '>=', $until);
//        elseif ($type === 2):
//            $where = $query->where('from_timestamp', '<', $from)
//                ->where('until_timestamp', '>', $until);
//        elseif ($type === 3):
//            $where = $query->where('from_timestamp', '>=', $from)
//                ->where('until_timestamp', '<=', $until);
//        elseif ($type === 4):
//            $where = $query->where('until_timestamp', '>', $from)
//                ->where('until_timestamp', '<', $until);
//        elseif ($type === 5):
//            $where = $query->where('from_timestamp', '>', $from)
//                ->where('from_timestamp', '<', $until);
//        endif;
//
//
//        return $where->where('status', $status[2]);
//    }


}
