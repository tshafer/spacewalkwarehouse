<?php namespace Wash\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Wash\AskTheExpert;
use Wash\Http\Controllers\Controller;

/**
 * @package Wash\Http\Controllers
 */
class AskTheExpertsController extends Controller
{

    /**
     *
     */
    public function index()
    {
        return view('frontend.asktheexperts.index');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $export = AskTheExpert::create($request->all());

        if ($export) {
            return redirect()->route('asktheexperts.thanks');
        }

        return view('frontend.asktheexperts.index');
    }

    /**
     *
     */
    public function thanks()
    {
        return view('frontend.asktheexperts.thanks');
    }
}
