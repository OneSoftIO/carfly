<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\BookingServices;
use App\Http\Controllers\Controller;
use App\Library\Vehicle as Car;
use App\Order;
use App\Settings;
use App\User;
use App\Vehicle;
use App\VehiclesTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeaseController extends Controller
{
    public $vehicles;
    public $status;
    protected $users;
    protected $lib;

    function __construct()
    {
        $this->vehicles = Vehicle::getActiveVehicles()->get();
        $this->users = User::all();
        $library = new Car;
        $this->status = $library->VehicleStatuses();
        $this->lib = new Car();
    }

    public function Page()
    {
        $reservations = Booking::with('Vehicles')->with('User')->with('order')->orderBy('created_at', 'DESC')->get();

        return view('admin.lease.list', compact('reservations'));
    }

    public function Reserve()
    {
        $vehicles = $this->vehicles;
        $users = $this->users;
        $status = $this->status;
        $terms = VehiclesTerm::all();
        return view('admin.lease.add', compact('vehicles', 'users', 'status', 'terms'));
    }

    public function ReserveSave(Request $request)
    {

//        if($this->lib->dateDifference($request->pickupDate, $request->dropoffDate))
//            return back()->withErrors(trans('page.contact_when_long_term'));

        if ($this->lib->CheckBookingList($request, $request->vehicle) === false):
            return back()->withErrors(trans('page.car_not_available'));
        endif;


        if ($this->UpdateOrCreateUserandBooking($request) == false)
            return back()->withErrors('Ši mašina jau yra rezervuota pasirinktas dienas.');


        return back()->with('success', 'Rezervacija išsaugota');
    }

    public function UpdateOrCreateUserandBooking($request, $id = 0)
    {

        $currentClient = $request->current_client;
        $validate = [
            'vehicle' => 'required',
            'status' => 'required',
            'pickupDate' => 'required',
            'from_hour' => 'required',
            'dropoffDate' => 'required',
            'until_hour' => 'required'
        ];

        if (empty($currentClient)) {
            $validate['email'] = 'required';
            $validate['name'] = 'required';
            $validate['phone_number'] = 'required';
//            $validate['driver_license'] = 'required';
//            $validate['passport'] = 'required';
        }
        $this->validate($request, $validate);

        $from = $request->pickupDate . " " . $request->from_hour . ":00";
        $until = $request->dropoffDate . " " . $request->until_hour . ":00";
        $fromTimeStamp = strtotime($from);
        $untilTimeStamp = strtotime($until);
        $status = array_keys($this->lib->VehicleStatuses());
        $days = $this->lib->ReservationDays($fromTimeStamp, $untilTimeStamp);

        if (empty($currentClient)):
            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'driver_license' => $request->driver_license,
                ]
            );
        endif;
        $booking = Booking::updateOrCreate(
            ['id' => $id],
            [
                'user_id' => (empty($currentClient)) ? $user->id : $currentClient,
                'car_id' => $request->vehicle,
                'status' => $request->status,
                'from' => $from,
                'from_timestamp' => $fromTimeStamp,
                'until' => $until,
                'until_timestamp' => $untilTimeStamp,
                'pickup' => $request->pickup,
                'address' => $request->address,
                'dropoff' => $request->dropoff,
                'info' => $request->info
            ]
        );
        $getOrder = Order::where('booking_id', $booking->id)->first();
        $setPrice = $this->lib->TotalPriceForVehicle($request->vehicle, $days);

        $order = Order::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'user_id' => (empty($currentClient)) ? $user->id : $currentClient,
                'token' => isset($getOrder->token) ? $getOrder->token : $this->generate_token(),
                'price' => isset($getOrder->price) ? $getOrder->price : $setPrice,
                'ip' => isset($getOrder->ip) ? $getOrder->ip : $request->ip(),
                'payment_status' => $request->payment_status,
            ]
        );
        $tags = $request->terms;

        BookingServices::where('order_id', $order->id)->delete();
        if (isset($tags)):
            foreach ($tags as $tag):
                $service = new BookingServices;
                $service->order_id = $order->id;
                $service->service_id = $tag;
                $service->save();
            endforeach;
        endif;
        return true;
    }

    protected function generate_token($length = 40)
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

    public function ReserveEdit($id)
    {
        $booking = Booking::where('id', $id)->with('order')->first();
        $vehicles = $this->vehicles;
        $users = $this->users;
        $status = $this->status;
        $orderID = Order::select('id')->where('booking_id', $id)->first()->id;
        $vehicleTerms = Vehicle::where('id', $booking->car_id)->first() ? Vehicle::where('id', $booking->car_id)->first()->terms : null;
        $bookingServices = BookingServices::select('service_id')->where('order_id', $orderID)->get();
        $collection = collect($vehicleTerms['value']);
        $vehicleTerms = $collection->map(function ($item, $key) {
            return intval($item);
        });
        $terms = VehiclesTerm::whereIn('id', $vehicleTerms)->get();
        return view('admin.lease.edit', compact('booking', 'vehicles', 'users', 'status', 'terms', 'bookingServices'));
    }

    public function ReserveUpdate(Request $request, $id)
    {

//        if($this->lib->dateDifference($request->pickupDate, $request->dropoffDate))
//            return back()->withErrors(trans('page.contact_when_long_term'));

        if ($this->lib->CheckBookingList($request, $request->vehicle) === false)
            return back()->withErrors(trans('page.car_not_available'));


        if ($this->UpdateOrCreateUserandBooking($request, $id) == false)
            return back()->withErrors('Ši mašina jau yra rezervuota pasirinktas dienas.');


        $order = Order::where('booking_id', $id)->with('user')->first();
        $orderUrl = route('order', $order->token);
        $email = Settings::select('option_value')->where('option_name', 'email')->first()->option_value;


        $data = [
            'email' => $email,
            'emailClient' => $order->user->email,
        ];

        if ($request->status === 'approved') {
            Mail::send('emails.order.client', ['id' => $id, 'url' => $orderUrl], function ($message) use ($data) {
                $message->from($data['email']);
                $message->subject('Užsakymo patvirtinimas');
                $message->to($data['emailClient']);
            });
        }

        return back()->with('success', 'Atnaujinta');
    }

    public function RemoveReservation($id)
    {
        Booking::find($id)->delete();

        return back()->with('success', 'Rezervacija panaikinta');
    }
}
