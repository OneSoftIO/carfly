<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 17-05-22
 * Time: 09:19
 */

namespace App\Services;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Netshell\Paypal\Facades\Paypal;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment as PaypalPayment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
//use PayPal\Api\Paypa

class PaypalAdapter
{
    private $_apiContext;
    private $_clientID;
    private $_secret;
    private $_mode;
    protected $accept_url;
    protected $callback_url;
    protected $cancel_url;
    protected $currency = 'EUR';

    public function __construct()
    {
        $this->_clientID = config('services.paypal.client_id');
        $this->_secret   = config('services.paypal.secret');
        $this->_mode   = config('services.paypal.mode', 'live');

        $this->_apiContext = PayPal::ApiContext($this->_clientID, $this->_secret);
        $this->_apiContext->setConfig(array(
            'mode' => $this->_mode,
            'service.EndPoint' => ($this->_mode == 'live') ? 'https://api.paypal.com' : 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    /**
     * @param Order $order
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function redirect(Order $order)
    {
        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
//                ->setFundingInstruments(array($fi));

        $items = [];
        foreach ($order->cart()->products as $product) {
            array_push($items, [
                'name' => $product->name,
                'quantity' => $product->qty,
                'currency' => $this->currency,
                'price' => floatval($product->subtotal),
                'tax' => $product->tax,
                'sku' => $product->rowId,
            ]);
        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        //Payment Amount
        $amount = new Amount();
        $amount->setCurrency($this->currency);
        $amount->setTotal($order->price);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription("Order #{$order->token}")
            ->setInvoiceNumber($order->token);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($this->accept_url); // Specify return URL
        $redirect_urls->setCancelUrl($this->cancel_url);

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = new PaypalPayment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
        } catch (PayPalConnectionException $ex) {
            return "Exception: " . $ex->getMessage() . PHP_EOL;
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if(isset($redirect_url)) {
            // redirect to paypal
            return redirect()->away($redirect_url);
        }

        return redirect()->back()->withErrors(['Unknown error occurred.']);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return bool
     */
    public function accept(Request $request, Order $order)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        if ($executePayment->state == "approved") {
            $order->update(['payment_status' => 'paid', 'paid_at' => Carbon::now()]);

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return string
     */
    public function callback(Request $request, Order $order)
    {
        return '';
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