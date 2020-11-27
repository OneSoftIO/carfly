<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /**
     * @param $value
     */
    use SoftDeletes;
    public function setCartAttribute($value)
    {
        $this->attributes['cart'] = serialize($value);
    }

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'token',
        'booking_id',
        'cart',
        'price',
        'phone',
        'ip',
        'payment_method',
        'payment_status',
        'paid_at'
    ];
    public function client(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }
    protected $dates = ['deleted_at'];
    /**
     * @param $value
     * @return string
     */
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2, ',', '');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCartAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * @return mixed
     */

    public function cart()
    {
        ShoppingCart::instance('order')->add(json_decode(json_encode($this->cart), true));
        $cart['products'] = ShoppingCart::instance('order')->content();
        $cart['count'] = ShoppingCart::instance('order')->content()->count();
        $cart['subtotal'] = ShoppingCart::instance('order')->subtotal();
        $cart['total'] = ShoppingCart::instance('order')->total();
        $cart['tax'] = ShoppingCart::instance('order')->tax();
        ShoppingCart::instance('order')->destroy();

        return json_decode(json_encode($cart));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function booking(){
        return $this->belongsTo('App\Booking');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->payment_status == 'pending';
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return $this->payment_status == 'canceled';
    }
    public function isWebToPay(){
        return $this->payment_method == 'webtopay';
    }
    public function isPayPal(){
        return $this->payment_method == 'paypal';
    }
    public function isCash(){
        return $this->payment_method == 'cash';
    }
}
