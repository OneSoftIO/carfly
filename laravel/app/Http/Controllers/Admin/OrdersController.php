<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function Page(){
        $orders = Order::with('client')->with('booking')->get();
        return view('admin.orders.list', compact('orders'));
    }

    public function remove($id){
        Order::destroy($id);

        return back()->with('success', 'Pašalinta sėkmingai');
    }
}
