<?php namespace App\Http\Controllers;

use App\Unit;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class CartController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        return view('cart');
    }


    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $unit = Unit::find($request->get('unit'));

        Cart::destroy();
        $media = ($unit->product->media->count() > 0) ? $unit->product->media->first()->getUrl('thumb') : null;

        $cartItem = Cart::add($unit->id, $unit->description, 1, $unit->price, ['product_name' => $unit->product->name, 'image' => $media]);

        return redirect()->route('cart.index');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $unitId
     *
     * @return mixed
     */
    public function destroy(Request $request, $unitId)
    {
        Cart::remove($unitId);

        flash('Item has been removed from your cart.');
        
        return redirect()->route('cart.index');

    }
}
