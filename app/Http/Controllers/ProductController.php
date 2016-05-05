<?php namespace App\Http\Controllers;

use App\Category;
use App\Product;

/**
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{

    /**
     * @param \App\Category $category
     * @param \App\Category $subcategory
     * @param \App\Product  $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, Category $subcategory, Product $product)
    {

        return view('product', compact('category', 'subcategory', 'product'));
    }
}
