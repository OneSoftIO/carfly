<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingServices;
use App\Library\Helper;
use App\Settings;
use App\User;
use App\Vehicle;
use App\VehiclesTerm;
use Illuminate\Http\Request;
use App\Order;
use App\Services\Payment;
use DB;
use \App\Library\Vehicle as Car;
class PaymentsController extends Controller
{
    protected $payment;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    public function show($token){
        $servicesPrice = 0;
        $order = Order::where('token', $token)->with('booking')->with('user')->first();
        $services = BookingServices::where('order_id', $order->id)->with('service')->get();
        $vehicle = Vehicle::find($order->booking->car_id);
        $delivery = Settings::select('option_value')->where('option_name', 'delivery')->first();

        $pickup =  $delivery->option_value['name'][$order->booking->pickup];
        $dropoff =  $delivery->option_value['name'][$order->booking->dropoff];
        $deliveryPrice = $delivery->option_value['price'][$order->booking->pickup] + $delivery->option_value['price'][$order->booking->dropoff];
        $getServices = BookingServices::where('order_id', $order->id)->get(['service_id', 'amount']);

        $days = (new Helper)->diffToDays($order->booking->from, $order->booking->until);

        $car = new Car;
//        $days = $car->ReservationDays($order->booking->from_timestamp, $order->booking->until_timestamp);


        $onlinePayments = Settings::select('option_value')->where('option_name', 'online_payments')->first();

        //$this->updateOrderPrice($order->id, $totalPrice);


        return view('order.order', compact( 'order', 'vehicle', 'services', 'pickup', 'dropoff', 'days', 'carPrice', 'onlinePayments'));
    }
    public function updateOrderPrice($id, $price){
        $order = Order::find($id);
        $order->price = $price;
        $order->update();

    }
    public function submit(Request $request, Order $order)
    {
        $validate = [
            'payment_method' => 'required',
        ];

//        if(isset($request->passport))
//            $validate['passport'] = 'required';

        if(isset($request->id))
            $validate['id'] = 'required';

        $this->validate($request, $validate);

        $order->update(['payment_method' => $request->get('payment_method')]);

        $userUpdate = User::where('id', $order->user_id);

//        if(isset($request->passport) && !empty($request->passport))
//            $userUpdate->update(['passport' => $request->passport]);
//
//        if(isset($request->id) && !empty($request->id))
//            $userUpdate->update(['driver_license' => $request->id]);
        (new Booking())->where('id', $order->booking_id)->update([
            'info' => $request->message
        ]);

        if($order->payment_method !== 'cash')
            return response()->json([
                'status' => true,
                'url' => route('payment', $order->token)
            ]);
        else
            return $this->CashProvider($order);

    }
    public function redirect(Order $order)
    {
        $user = User::select('email', 'name', 'phone_number')->where('id', $order->user_id)->first();

        $this->payment->setPaymentMethod($order->payment_method);
        $this->payment->setCurrency('EUR');
        $this->payment->setAcceptUrl(route('payment.accept', $order->token));
        $this->payment->setCallbackUrl(route('payment.callback', $order->token));
        $this->payment->setCancelUrl(route('payment.cancel', $order->token));
        if(!empty($user))
            return $this->payment->redirect($order, $user);
        else
           return redirect()->route('order', $order->token)->withErrors([trans('payment.canceled')]);

//        return $user;
    }
    public function CashProvider($order){
        $redirect = route('order', $order->token);
//        $order->update(['payment_status' => 'paid']);

        $car = new Car;
        $car->SendConfirmMessage($order->token);


        return response()->json([
            'status' => true,
            'url' => $redirect
        ]);
    }
    public function callback(Request $request, Order $order)
    {
        $this->payment->setPaymentMethod($order->payment_method);

        return $this->payment->callback($request, $order);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, Order $order)
    {
        $this->payment->setPaymentMethod($order->payment_method);

        if ($this->payment->accept($request, $order) == false) {
            $this->payment->cancel($request, $order);

            return redirect()->route('order', $order->token)->withErrors([trans('payment.error')]);
        }
        (new Car)->SendConfirmMessage($order->token);

        return redirect()->route('order', $order->token)->with('success', trans('payment.success'));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return $this
     */
    public function cancel(Request $request, Order $order)
    {
        $this->payment->setPaymentMethod($order->payment_method);
        $this->payment->cancel($request, $order);

        return redirect()->route('order', $order->token)->withErrors([trans('payment.canceled')]);
    }
}
