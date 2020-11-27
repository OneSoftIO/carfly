<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Order::all();

        foreach($orders as $order){
            $booking = \App\Booking::where('id', $order->booking_id)->first();
            if($booking) {
                $days = \App\Library\Helper::diffToDays($booking->from, $booking->until);


                $deliveryPrice = $this->getDeliveryPrice($booking->pickup, $booking->dropoff);
                $servicePrice = $this->getServicePrice($order->id);



                if($order->total_price > 0) {
                    $priceWithoutExtra = $order->total_price - $servicePrice - $deliveryPrice;
                } else {
                    $priceWithoutExtra = $order->price - $servicePrice - $deliveryPrice;
                }

                $price = $priceWithoutExtra;

                $update = \App\Order::where('id', $order->id)->update(
                    [
                        'total_price' => ($order->total_price > 0)?$order->total_price:$order->price,
                        'price' => $price,
                        'delivery_price' => $deliveryPrice,
                        'service_price' => $servicePrice
                    ]
                );
                if($update)
                    print "Updated: {$order->id}\n";
            }
        }
    }

    /**
     * @param int $booking_id
     */
    public function getServicePrice(int $order_id){
        $services = \App\BookingServices::where('order_id', $order_id)->get();

        $price = 0;
        if($services) {
            foreach ($services as $item) {
                $term = \App\VehiclesTerm::where('id', $item->service_id)->first();
                $price += $term->price;
            }
        }

        return $price;

    }
    public function getDeliveryPrice(int $pickup, int $dropoff){
        $price = 0;
        $delivery = \App\Settings::where('option_name', 'delivery')->pluck('option_value')->pluck('price')->first();

        $price += $delivery[$pickup];
        $price += $delivery[$dropoff];

        return $price;

    }
}
