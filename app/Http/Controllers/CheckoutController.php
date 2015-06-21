<?php namespace App\Http\Controllers;

class CheckoutController extends Controller
{
	private $_apiContext;

	public function __construct()
	{
		/*$this->_apiContext = PayPal::ApiContext(config('services.paypal.client_id'), config('services.paypal.secret'));
		
		$this->_apiContext->setConfig(array(
			'mode' => 'sandbox',
			'service.EndPoint' => 'https://api.sandbox.paypal.com',
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled' => true,
			'log.FileName' => storage_path('logs/paypal.log'),
			'log.LogLevel' => 'FINE'
		));
*/
		$this->middleware('auth', ['only' => 'getIndex']);
	}
	public function getDone(Request $request)
	{
		$id = $request->get('paymentId');
		$token = $request->get('token');
		$payer_id = $request->get('PayerID');
		
		$payment = PayPal::getById($id, $this->_apiContext);
		$paymentExecution = PayPal::PaymentExecution();
		$paymentExecution->setPayerId($payer_id);
		$executePayment = $payment->execute($paymentExecution, $this->_apiContext);
		$order = Order::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->first();
		
		if(!is_null($order)) {
			$order->payment = $id;
			$order->save();
		}
		Cart::clear();
		return view('checkout.done');
	}
	
	public function getCancel() {
		return view('checkout.cancel');
	}
	
	public function postIndex()
	{
		$total = 0; //$request->

		$payer = PayPal::Payer();
		$payer->setPaymentMethod("paypal");
		$amount = PayPal:: Amount();
		$amount->setCurrency(config('app.checkout_currency'));
		$amount->setTotal($total);
		$transaction = PayPal:: Transaction();
		$transaction->setAmount($amount);
		$transaction->setDescription(trans('app.checkout_description', ['count' => 1]));
		$redirectUrls = PayPal:: RedirectUrls();
		$redirectUrls->setReturnUrl(url('/checkout/done'));
		$redirectUrls->setCancelUrl(url('/checkout/cancel'));
		$payment = PayPal:: Payment();
		$payment->setIntent("sale");
		$payment->setPayer($payer);
		$payment->setRedirectUrls($redirectUrls);
		$payment->setTransactions(array($transaction));
		$response = $payment->create($this->_apiContext);
		$redirectUrl = $response->links[1]->href;
		$order = new Order([
				'total' => Cart::getTotal(),
				'user_id' => Auth::user()->id,
			]);
		$order->save();
		
		return Redirect::to($redirectUrl);
	}
}