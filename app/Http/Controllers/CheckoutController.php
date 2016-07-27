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
        return view('checkout');
    }


    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'state'      => 'required',
            'zip'        => 'required',
        ]);
        $unitRequest = UnitRequest::create($request->all());

        foreach (Cart::content() as $unit) {
            $unitRequest->units()->attach($unit->id);
        }

        $data = $request->all();

        Mail::send('emails.sendRequest', ['data' => $data], function ($message) {

            $message->subject('Space Walk Sales Requests Form');
            $message->from('sales@spacewalk.com', 'Space Walk Sales Request');

            $message->to('tj@tjshafer.com');

        });


        Cart::destroy();

        return redirect()->route('thanks');

    }

}
