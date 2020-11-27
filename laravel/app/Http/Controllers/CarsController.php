<?php

namespace App\Http\Controllers;

use App\BookingServices;
use App\Library\Helper;
use App\Order;
use App\Settings;
use App\Vehicle;
use App\VehiclesTerm;
use Illuminate\Http\Request;
use App\Booking;
use DB;
use App\Price;
use App\User;
use Carbon\Carbon;
use App\Library\Vehicle as Car;

class CarsController extends Controller
{
    private $bookingModel, $lib;
    public function __construct()
    {
        $this->bookingModel = new Booking();
        $this->lib = new Car();
    }

    public function Page(Request $request){
        $library = new Car;
        if(!$request->has('pickupTime')):
            $vehicles = Vehicle::getActiveVehicles()->with('prices')->with('bookings')->paginate(20);
        elseif($library->dateDifference($request->pickupDate, $request->dropoffDate)):
            return redirect()->route('cars.page')->with('err', trans('page.contact_when_long_term'));
        else:
            $vehicles = $this->SearchCars($request);
        endif;

        if($request->has('price')){
            $from = $request->price_from;
            $to = $request->price_to;

            $vehiclesID = Price::where('from', 1)->whereBetween('price', [$from, $to])->orwhereBetween('discount',[$from, $to])->pluck('vehicle_id')->toArray();
            $vehicles = Vehicle::whereIn('id', $vehiclesID)
                ->orderBy('ord', 'ASC')->paginate(20);
        }
        return view('cars.cars', compact('vehicles'));
    }

    public function SearchCars($request){
            $from = $request->pickupDate ." ".$request->pickupTime . ":00";
            $until = $request->dropoffDate ." ".$request->dropoffTime . ":00";
            $fromTimeStamp = strtotime($from);
            $untilTimeStamp =  strtotime($until) + 8 * 3600;
            $status = array_keys($this->lib->VehicleStatuses());
            $fromtime = strtotime($from) - 8 * 3600;

            $scene1 = $this->bookingModel->where('from_timestamp', '<=', $fromtime)
                ->where('until_timestamp', '>=', $untilTimeStamp)
                ->where('status',$status[1])
                ->pluck('car_id')->toArray();


            $scene2 =  $this->bookingModel->where('from_timestamp', '<', $fromtime)
                ->where('until_timestamp', '>', $untilTimeStamp)
                ->where('status',$status[1])
                ->pluck('car_id')->toArray();

            $scene3 =  $this->bookingModel->where('from_timestamp', '>=', $fromtime)
                ->where('until_timestamp', '<=', $untilTimeStamp)
                ->where('status',$status[1])
                ->value('car_id');

            $scene4 =  $this->bookingModel->where('until_timestamp', '>', $fromtime)
                ->where('until_timestamp', '<', $untilTimeStamp)
                ->where('status',$status[1])
                ->pluck('car_id')->toArray();

            $scene5 =  $this->bookingModel->where('from_timestamp', '>', $fromtime)
                ->where('from_timestamp', '<', $untilTimeStamp)
                ->where('status',$status[1])
                ->pluck('car_id')->toArray();

            $result = array_merge((array)$scene1, (array)$scene2, (array)$scene3, (array)$scene4, (array)$scene5);

            return Vehicle::getActiveVehicles()->with('prices')->whereNotIn('id', $result)->orderBy('ord', 'ASC')->paginate(20);

    }
    public function PageCar($id){
        $vehicle = Vehicle::where('id', $id)->with('prices')->first();
        $terms = VehiclesTerm::CarTerms($vehicle->terms['value'])->get();
        return view('cars.car', compact('vehicle', 'terms'));
    }
    public function Reserve(Request $request, $id){

        $library = new Car;

        $this->validate($request, [
           'pickupDate' => 'required',
           'from_hour' => 'required',
           'dropoffDate' => 'required',
           'until_hour' => 'required',
           'name' => 'required',
           'email' => 'required',
           'phone' => 'required',
           'living_address' => 'required',
           'type' => 'required',
           'privacy_policy' => 'required'
        ]);


        $from = $request->pickupDate." ".$request->from_hour;
        $to = $request->dropoffDate." ".$request->until_hour;

        $days = (new Helper)->diffToDays($from, $to);
        $getPriceForVehicle = (new Car)->TotalPriceForVehicle($id, (int) $days);

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone,
                'type' => $request->type,
                'address' => $request->living_address,
                'company_name' => $request->company_name,
                'company_code' => $request->company_code
            ]
        );
        if($library->dateDifference($request->pickupDate, $request->dropoffDate))
            return response()->json([
                'message' => trans('page.contact_when_long_term'),
                'status' => "danger"
            ]);


        if( $library->CheckBookingList($request, $id) == false):
            return response()->json([
                'message' => trans('page.car_not_available'),
                'status' => "danger"
            ]);
        endif;

        $from = $request->pickupDate ." ".$request->from_hour . ":00";
        $until = $request->dropoffDate ." ".$request->until_hour . ":00";
        $fromTimeStamp = strtotime($from);
        $untilTimeStamp =  strtotime($until);
        $status = array_keys($library->VehicleStatuses());

        $services = $request->services;
        $amount = $request->services_amount;
        $servicesPrice = 0;

        foreach ($services as $service){
            $price = (new VehiclesTerm())->countTermPrice($service, $days);
            $amount = (!empty($request->services_amount[$service]))?$request->services_amount[$service]:1;
            $servicesPrice += $price * $amount;
        }
        $servicesPrice = $servicesPrice * $days;
        $delivery_from_price = (new Car)->getDeliveryPrice($request->pickup, $days);
        $delivery_to_price = (new Car)->getDeliveryPrice($request->dropoff, $days);

        $deliveryPrice = $delivery_from_price + $delivery_to_price;


        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->car_id = $id;
        $booking->status = $status[0];
        $booking->from = $from;
        $booking->from_timestamp = $fromTimeStamp;
        $booking->until = $until;
        $booking->address = $request->address;
        $booking->until_timestamp = $untilTimeStamp;
        $booking->pickup = $request->pickup;
        $booking->dropoff = $request->dropoff;
        $booking->created_at = Carbon::now();
        $booking->privacy_policy = $request->privacy_policy;
        $booking->save();

        $order = new Order;
        $order->user_id = $user->id;
        $order->token = $this->generate_token();
        $order->booking_id = $booking->id;
        $order->price = $getPriceForVehicle;
        $order->total_price = $getPriceForVehicle + $deliveryPrice + $servicesPrice;
        $order->delivery_price = $deliveryPrice;
        $order->service_price = $servicesPrice;
        $order->ip = $request->ip();
        $order->payment_status = 'pending';
        $order->save();


        if($services && !empty($services)):
            foreach ($services as $ser):
                $vehicleTerm = VehiclesTerm::where('id', $ser)->first();
                $service = new BookingServices;
                $service->order_id = $order->id;
                $service->service_id = $ser;
                $service->amount =  (!empty($request->services_amount[$ser]))?$request->services_amount[$ser]:1;
                $service->save();
            endforeach;
        endif;


        return response()->json([
            'message' => trans('page.order_success'),
            'status' => "success",
            'redirect_url' => route('order', $order->token)
        ]);
    }


    protected function generate_token($length = 20)
    {
        $key = app('config')['app.key'];

        if (\Illuminate\Support\Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        do {
            $token = substr(hash_hmac('sha256', \Illuminate\Support\Str::random($length), $key), 0, $length);
        } while (Order::where('token', $token)->exists());

        return $token;
    }
    public function GetPrice(Request $request){

        $from = $request->from." ".$request->pickupTime;
        $to = $request->until." ".$request->dropoffTime;

        $days = (new Helper)->diffToDays($from, $to);

        $delivery_from_price = (new Car)->getDeliveryPrice($request->delivery_from, $days);
        $delivery_to_price = (new Car)->getDeliveryPrice($request->delivery_to, $days);

        $setPrice = (new Car)->TotalPriceForVehicle($request->id, (int) $days);
        $carTerms = (new Vehicle)->getTermsAttr($request->id)['value'];

        $getCarTerms  = (new VehiclesTerm)->getVehicleTerms($carTerms, $days);

        return response()->json([
            'price' => $setPrice,
            'days' => $days,
            'terms' => $getCarTerms,
            'delivery_price' => [
                'take'=> (float) $delivery_from_price,
                'return' => (float) $delivery_to_price,
                'total' => $delivery_from_price + $delivery_to_price
            ]
        ]);
    }

}
