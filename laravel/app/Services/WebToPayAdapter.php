<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 17-05-22
 * Time: 09:17
 */

namespace App\Services;


use App\Order;
use App\Services\Paysera\WebToPay;
use App\Services\Paysera\WebToPayException;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebToPayAdapter
{
    protected $project_id;
    protected $sign_password;
    protected $test;
    protected $accept_url;
    protected $callback_url;
    protected $cancel_url;
    protected $currency = 'EUR';

    /**
     * WebToPayAdapter constructor.
     */
    public function __construct()
    {
        $this->project_id = config('services.paysera.project_id');
        $this->sign_password = config('services.paysera.sign_password');
        $this->test = config('services.paysera.test');
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function redirect(Order $order, $user)
    {
        try {
            WebToPay::redirectToPayment([
                'projectid'     => $this->project_id,
                'sign_password' => $this->sign_password,
                'orderid'       => $order->token,
                'amount'        => $order->total_price * 100,
                'currency'      => $this->currency,
                'country'       => 'LT',
                'p_firstname'   => $user->name,
                'p_email'       => $user->email,
                'accepturl'     => $this->accept_url,
                'cancelurl'     => $this->cancel_url,
                'callbackurl'   => $this->callback_url,
                'test'          => $this->test,
            ]);

        } catch (WebToPayException $e) {
            return redirect()->back()->withErrors([trans('payment.invalid')]);
        }
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return bool
     */
    public function accept(Request $request, Order $order)
    {
        return true;
    }

    /**
     * @param Request $request
     * @param Order $order
     */
    public function callback(Request $request, Order $order)
    {
        try {
            $response = WebToPay::checkResponse($_GET, array(
                'projectid'     => $this->project_id,
                'sign_password' => $this->sign_password,
            ));

//            if ($response['test'] !== '0') {
//                throw new \Exception('Testing, real payment was not made');
//            }
            if ($response['type'] !== 'macro') {
                throw new \Exception('Only macro payment callbacks are accepted');
            }

            $orderId = $response['orderid'];
            $amount = $response['amount'];
            $currency = $response['currency'];

            //@todo: patikrinti, ar užsakymas su $orderId dar nepatvirtintas (callback gali būti pakartotas kelis kartus)
            if ($order->token != $orderId) {
                throw new \Exception('Invalid order id');
            }

            //@todo: patikrinti, ar užsakymo suma ir valiuta atitinka $amount ir $currency
            if ($amount != ($order->price * 100)) {
                throw new \Exception('amount != order price');
            }

            //@todo: patvirtinti užsakymą
            $order->update(['payment_status' => 'paid', 'paid_at' => Carbon::now()]);

            return 'OK';
        } catch (\Exception $e) {
            return get_class($e) . ': ' . $e->getMessage();
        }
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function cancel(Request $request, Order $order)
    {
        return $order->update(['payment_status' => 'canceled']);
    }

    /**
     * @return mixed
     */
    public function getAcceptUrl()
    {
        return $this->accept_url;
    }

    /**
     * @param mixed $accept_url
     */
    public function setAcceptUrl($accept_url)
    {
        $this->accept_url = $accept_url;
    }

    /**
     * @return mixed
     */
    public function getCallbackUrl()
    {
        return $this->callback_url;
    }

    /**
     * @param mixed $callback_url
     */
    public function setCallbackUrl($callback_url)
    {
        $this->callback_url = $callback_url;
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->cancel_url;
    }

    /**
     * @param mixed $cancel_url
     */
    public function setCancelUrl($cancel_url)
    {
        $this->cancel_url = $cancel_url;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}