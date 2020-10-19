<?php namespace App\Http\Controllers;

use App\UnitRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {

        if(Cart::instance(session('cartId'))->count() == 0)
            return redirect()->route('home');

        return view('checkout');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'email'           => 'email|required',
        ]);

        $unitRequest       = UnitRequest::create($request->all());
        $unitRequest->cart =  Cart::instance(session('cartId'))->content()->toJson();
        $unitRequest->save();

        foreach (Cart::instance(session('cartId'))->content() as $unit) {
            $unitRequest->units()->attach($unit->id);
        }

        $data = $request->all();

        $content = Cart::instance(session('cartId'))->content();

        Mail::send('emails.sendRequest', ['data' => $data, 'cart' => $content, 'units' => $unitRequest], function ($message) use ($data) {
            $name = implode(' ', [array_get($data, 'first_name'), array_get($data, 'last_name')]);
            $message->replyTo(array_get($data, 'email'), $name);
            $message->subject('Space Walk Sales Requests Form');
            $message->from('sales@spacewalk.com', 'Space Walk Sales Request');

            $message->to('Kelsey@herecomesfun.com');
        });


        Cart::instance(session('cartId'))->destroy();

        return redirect()->route('thanks');

    }

}
