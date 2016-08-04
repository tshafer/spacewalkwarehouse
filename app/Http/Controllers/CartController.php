<?php namespace App\Http\Controllers;

use App\Unit;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        $category = $unit->product->categories->first();

        $media = ($unit->product->getMedia('products')->count() > 0) ? $unit->product->getMedia('products')->first()->getUrl('thumb') : null;

        Cart::instance(session('cartId'))->add($unit->id, $unit->description, 1, $unit->price, [
            'product_name' => $unit->product->name,
            'image'        => $media,
            'productSlug'  => $unit->product->slug,
            'categorySlug' => $category->slug,
            'width'        => $unit->width,
            'length'       => $unit->length,
            'height'       => $unit->height,
            'weight'       => $unit->weight,
            'model'        => $unit->model,
        ]);

        Session::flash('backUrl', route('category' ,  [$category->slug]));

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
        Cart::instance(session('cartId'))->remove($unitId);

        flash('Item has been removed from your cart.');

        return redirect()->route('cart.index');

    }
}
