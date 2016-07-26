<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        return view('index');
    }


    /**
     * @return mixed
     */
    public function about()
    {
        return view('about');
    }


    /**
     * @return mixed
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * @return mixed
     */
    public function termsConditions()
    {
        return view('terms_conditions');
    }
    

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function contactPost(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        $data = $request->all();

        Mail::send('emails.send', ['data' => $data], function ($message) {
            
            $message->subject('Space Walk Sales Contact Form');
            $message->from('admin@patiodeckhearth.com', 'pace Walk Sales  Contact Form');

            $message->to('tj@tjshafer.com');

        });

        return redirect()->route('contact')->withMessage('Thank you for contacting us. We will be in touch soon.');
    }

}
