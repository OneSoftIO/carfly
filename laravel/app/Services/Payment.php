<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 17-05-22
 * Time: 09:16
 */

namespace App\Services;


use App\Order;
use Illuminate\Http\Request;

class Payment
{
    /**
     * @var
     */
    protected $payment_method;
    protected $gateway;

    /**
     * @param $payment_method
     * @return $this
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        $this->gateway = $this->setGateway($payment_method);

        return $this;
    }

    /**
     * @param $payment_method
     * @return \Illuminate\Foundation\Application|mixed
     * @throws \Exception
     */
    private function setGateway($payment_method)
    {
        if (app()->bound('payment.' . $payment_method)) {
            return app('payment.' . $payment_method);
        }

        throw new \Exception('Payment method not exist');
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function redirect(Order $order, $user)
    {
        return $this->gateway->redirect($order, $user);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return mixed
     */
    public function callback(Request $request, Order $order)
    {
        return $this->gateway->callback($request, $order);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return mixed
     */
    public function accept(Request $request, Order $order)
    {
        return $this->gateway->accept($request, $order);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return mixed
     */
    public function cancel(Request $request, Order $order)
    {
        return $this->gateway->cancel($request, $order);
    }

    /**
     * @param mixed $accept_url
     */
    public function setAcceptUrl($accept_url)
    {
        $this->gateway->setAcceptUrl($accept_url);
    }

    /**
     * @param mixed $callback_url
     */
    public function setCallbackUrl($callback_url)
    {
        $this->gateway->setCallbackUrl($callback_url);
    }

    /**
     * @param mixed $cancel_url
     */
    public function setCancelUrl($cancel_url)
    {
        $this->gateway->setCancelUrl($cancel_url);
    }

    /**
     * @param $currency
     */
    public function setCurrency($currency)
    {
        $this->gateway->setCurrency($currency);
    }
}