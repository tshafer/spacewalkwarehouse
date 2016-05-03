<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\AskTheExpert;
use App\Http\Controllers\Controller;

/**
 * @package App\Http\Controllers
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
