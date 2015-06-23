<?php namespace App\Http\Controllers;

use Auth;
use Exception;
use PayPal;
use Illuminate\Http\Request;
use App\Order;
use App\Log;

class CheckoutController extends Controller
{
	private $_apiContext;

	public function __construct()
	{
		$this->_apiContext = PayPal::ApiContext(config('services.paypal.client_id'), config('services.paypal.secret'));
		
		$this->_apiContext->setConfig(array(
			'mode' => 'sandbox',
			'service.EndPoint' => 'https://api.sandbox.paypal.com',
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled' => true,
			'log.FileName' => storage_path('logs/paypal.log'),
			'log.LogLevel' => 'FINE'
		));

		$this->middleware('auth', ['only' => 'getIndex']);
	}
	
	public function postIndex(Request $request)
	{
		$plan = $request->input('plan');
		$config = config('br.plans.' . $plan);
		
		if(!is_array($config))
			return redirect()->back('/');
		
		$total = $config['cost'];

		$payer = PayPal::Payer();
		$payer->setPaymentMethod("paypal");
		$amount = PayPal:: Amount();
		$amount->setCurrency(config('br.checkout.currency_code'));
		$amount->setTotal($total);
		$transaction = PayPal:: Transaction();
		$transaction->setAmount($amount);
		$transaction->setDescription(trans('app.checkout_description', $config));
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
				'total' => $total,
				'plan' => $plan,
				'user_id' => Auth::id()
			]);
		(new Log([
				'user_id' => Auth::id(),
				'reason' => 'purchase',
				'reward' => $config['points']
				]))->save();
		$order->save();
		
		return redirect($redirectUrl);
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

		$order = Order::whereUserId(Auth::id())->orderBy('created_at', 'desc')->first();
		if(!is_null($order)) {
			$order->payment = $id;
			$order->save();
		}

		$log = Log::whereUserId(Auth::id())->whereReason('purchase')->orderBy('created_at', 'desc')->first();
		if(!is_null($log)) {
			$log->flag = true;
			$log->save();
		}
		
		return view('checkout.done');
	}
	
	public function getCancel() {
		return view('checkout.cancel');
	}
}