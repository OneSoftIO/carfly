<?php

namespace App\Library;


use App\Order;
use App\Price;
use App\Settings;
use Illuminate\Support\Facades\Mail;
use App\Booking;
class Vehicle {

    protected $adminEmail;

    public function __construct()
    {
        $this->adminEmail = Settings::select('option_value')
            ->where('option_name', 'email')
            ->first()
            ->option_value;
    }

    public function ReservationDays($from, $until){
        $datediff = $until - $from;
        $days = round($datediff / (60 * 60 * 24));

        if($days == 0) {
            return 1;
        }

        return $days;
    }

    public function TotalPriceForVehicle($id, int $days){
        $prices = Price::where('vehicle_id', $id)->get();

        foreach ($prices as $price):
            if($days >= $price->from && $days <= $price->to)
                $sum = (!empty($price->discount))?$price->discount * $days :$price->price * $days;
        endforeach;

        //more days
        if(!isset($sum)){
            $mrice = array_column($prices->toArray(), 'price');
            $min_price = min($mrice);

            foreach ($prices as $price):
                if($price->price === $min_price)
                    $sum = (!empty($price->discount))?$price->discount * $days :$price->price * $days;
            endforeach;
        }

        return $sum;
    }

    public function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        //if more than 30 days
        if($interval->format($differenceFormat) > 29)
            return true;
        else
            return false;

    }
    public function SendConfirmMessage($token){
        $order = Order::where('token', $token)->with('user')->first();
        $orderId = $order->booking_id;
        $clientEmail = $order->user->email;
        $orderUrl = route('order', $token);

        //send meessage to admin
        $this->sendMessage([
            'email' => $this->adminEmail,
            'customer_email' => $this->adminEmail,
            'template' => 'emails.order.admin',
            'subject' => trans('emails.order.admin.subject')
        ],[
            'id' => $orderId,
            'url' => $orderUrl
        ]);

        //send message to customer
        $this->sendMessage([
            'email' => $this->adminEmail,
            'customer_email' => $clientEmail,
            'template' => 'emails.order.process',
            'subject' => trans('emails.order.process.subject')
        ],[
            'id' => $orderId,
            'url' => $orderUrl
        ]);
    }

    /**
     * @param array $data
     * @param array $options
     */
    protected function sendMessage(array $data, array $options = []){
        Mail::send($data['template'], $options, function ($message) use ($data)
        {
            $message->from($data['email']);
            $message->subject($data['subject']);
            $message->to($data['customer_email']);
        });
    }
    public function CheckBookingList($request, $carID){
        $from = $request->pickupDate ." ".$request->from_hour . ":00";
        $until = $request->dropoffDate ." ".$request->until_hour . ":00";
        $fromTimeStamp = strtotime($from);
        $untilTimeStamp =  strtotime($until) + 8 * 3600;
        $status = array_keys($this->VehicleStatuses());
        $fromtime = strtotime($from) - 8 * 3600;


        $scene1 = Booking::where('car_id',$carID)
            ->where('from_timestamp', '<=', $fromtime)
            ->where('until_timestamp', '>=', $untilTimeStamp)
            ->where('status',$status[1])
            ->count();

        $scene2 =  Booking::where('car_id',$carID)
            ->where('from_timestamp', '<', $fromtime)
            ->where('until_timestamp', '>', $untilTimeStamp)
            ->where('status',$status[1])
            ->count();

        $scene3 =  Booking::where('car_id',$carID)
            ->where('from_timestamp', '>=', $fromtime)
            ->where('until_timestamp', '<=', $untilTimeStamp)
            ->where('status',$status[1])
            ->count();

        $scene4 =  Booking::where('car_id',$carID)
            ->where('until_timestamp', '>', $fromtime)
            ->where('until_timestamp', '<', $untilTimeStamp)
            ->where('status',$status[1])
            ->count();

        $scene5 =  Booking::where('car_id',$carID)
            ->where('from_timestamp', '>', $fromtime)
            ->where('from_timestamp', '<', $untilTimeStamp)
            ->where('status',$status[1])
            ->count();


        // if any event exist, means more than 0, return false
        if($scene1 + $scene2 + $scene3 + $scene4 + $scene5 > 0){
            return false;
        }

        return true;
    }

    public function VehicleStatuses(){
        return ['confirmation' => "Laukiama patvirtinimo" ,'approved' => "Patvirtintas", 'disapproved' => "Atšauktas"];
        //Laukiama patvirtinimo, Patvirtintas, Nepatvirtintas


    }

    public function getVehiclesClasses(){
        return [
            1 => [
                'name' => trans('page.classes.eco'),
            ],
            2 => [
                'name' => trans('page.classes.compact')
            ],
            3 => [
                'name' => trans('page.classes.standart')
            ],
            4 => [
                'name' => trans('page.classes.suv')
            ]
        ];
    }

    /**
     * @param int $id
     * @param int $days
     */
    public function getDeliveryPrice(int $id, int $days)
    {
        $price = null;
        $delivery_points = Settings::select('option_value')
            ->where('option_name', 'delivery')
            ->first()
            ->option_value;

        $delivery_from = $delivery_points['date_from'][$id];
        $delivery_to = $delivery_points['date_to'][$id];
        $prices = $delivery_points['price'][$id];

        foreach ($delivery_from as $key => $from){
            if($from <= $days && ($delivery_to[$key] == 0 || $delivery_to[$key] >= $days)){
                $price = $prices[$key];
                break;
            }
        }

        if(is_null($price)){
            $price = max($prices);
        }

        return $price;
    }
}