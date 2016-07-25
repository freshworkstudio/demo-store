<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\WebpayOneClick;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class CheckoutController extends Controller
{
    /** @var  WebpayOneClick */
    protected $oneclick;
    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $bag = CertificationBagFactory::integrationOneClick();
        $this->oneclick = TransbankServiceFactory::oneclick($bag);
        $this->middleware('auth');
    }

    public function checkout(Cart $cart)
    {
        $products = $cart->content();
	    if ($products->count() <= 0)
	    {
	    	flash()->error('Tu carro de compra está vacío');
	    	return redirect()->back();
	    }
        $total = $cart->total(0, ',', '.');
        $tax = $cart->tax(0, ',', '.');
        return view('checkout', compact('products', 'total', 'tax'));
    }

	public function authorizeOneClick(Guard $auth)
	{
		//Check if the user has already authorized a credit card
		if (!$auth->user()->hasAuthorizedCreditCard())
		{
			//init inscription of a card
			$response = $this->oneclick->initInscription($auth->user()->email, $auth->user()->email, route('tbk.oneclick.response'));
			return RedirectorHelper::redirectHTML($response->urlWebpay, $response->token);
		}

    }

    public function process(Cart $cart, Guard $auth)
    {
		$this->authorizeOneClick($auth);
	    //If we are here, then the user already has a credit card authorized

        $total = $cart->total(0,'','');
	    if ($total <= 0) {
	    	flash()->error('No se puede pagar una compra vacía');
	    	return redirect()->back();
	    }

        $transaction = new Transaction();
        $transaction->amount = $total;
        $transaction->user_id = $auth->user()->getAuthIdentifier();
        $transaction->save();

        $products = $cart->content();

        foreach($products as $product)
        {
            $transaction->products()->attach($product->id, ['qty' => $product->qty]);
        }

        $buyOrder = $transaction->createNewBuyOrder();
        $transaction->save();

        try {
            $response = $this->oneclick->authorize($total, $buyOrder, $auth->user()->email, $auth->user()->tbkToken);
        }catch (\Exception $e) {
            flash()->error('La transacción fue rechazada. Intenta asociar otra tarjeta. (' . $e->getMessage() . ')');
            return redirect()->route('checkout.failed', ['txid' => $transaction->id]);
        }

	    foreach($response as $key => $value)
	    {
		    $transaction->addMeta($key, $value, 'oneclick_response');
	    }

        if($response->responseCode != '0')
        {
            return redirect()->route('checkout.failed', ['txid' => $transaction->id]);
        }

        $transaction->completed_at = Carbon::now();
        $transaction->save();



        $cart->destroy();

        return redirect()->route('checkout.thanks', ['txid' => $transaction->id]);

    }

    public function oneclickResponse(Guard $auth)
    {
        $response = $this->oneclick->finishInscription();

        if($response->responseCode != 0)
        {
            flash()->error('La tarjeta ha sido rechazada.');
            return redirect()->route('checkout');
        }

        $user = $auth->user();
        $user->tbkToken = $response->tbkUser;
        $user->cc_final_numbers = $response->last4CardDigits;
        $user->save();
		flash()->success('Su tarjeta se ha inscrito satisfactoriamente');
        return redirect()->route('checkout');
    }

    public function thanks(Request $request, Guard $auth)
    {
        $transaction = $auth->user()->transactions()->findOrFail($request->get('txid'))->loadMeta();
        $products = $transaction->products()->withPivot('qty')->get();
        return view('thanks', compact('transaction', 'products'));
    }

    public function failed(Request $request, Guard $auth)
    {
        $transaction = $auth->user()->transactions()->findOrFail($request->get('txid'))->loadMeta();
        $products = $transaction->products()->withPivot('qty')->get();
        return view('failed', compact('transaction', 'products'));
    }

    public function deletecc(Guard $auth)
    {
        $user = $auth->user();
        if (!$user) abort(401);

        if ($user->hasAuthorizedCreditCard())
        {
            ($this->oneclick->removeUser($user->tbkToken, $user->email));

            $user->tbkToken = null;
            $user->save();
        }

        return redirect()->back();

    }
}
