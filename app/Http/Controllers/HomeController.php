<?php namespace App\Http\Controllers;

use App\Manufacturer;

/**
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $manufacturers = Manufacturer::whereEnabled(1)->get();

        return view('index', compact('manufacturers'));
    }
}
