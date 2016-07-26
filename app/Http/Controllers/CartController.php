<?php namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * @package App\Http\Controllers
 */
class CartController extends Controller
{

    /**
     * @param \App\Product $product
     */
    public function add(Product $product)
    {

        $cartItem = Cart::add($product->id, $product->description, 1, $product->price);
    }
}
