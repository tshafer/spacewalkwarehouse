<?php namespace App\Http\Controllers;

use App\Category;

/**
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{

    /**
     * @param \App\Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category)
    {
        
        return view('category', compact('category'));
    }


    /**
     * @param \App\Category $category
     * @param \App\Category $subcategory
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subCategory(Category $category, Category $subcategory)
    {

        return view('subcategory', compact('category', 'subcategory'));
    }
}
