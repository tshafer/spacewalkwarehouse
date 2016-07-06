<?php namespace App\Http\Controllers;

use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $manufacturers = Manufacturer::whereEnabled(1)->with('media')->get();

        return view('index', compact('manufacturers'));
    }


    /**
     * @return mixed
     */
    public function outdoorFurnitureCleveland()
    {
        $xmlFile = app_path() . '/xml/perfect-patios-decks.xml';

        $xml = simplexml_load_file($xmlFile);

        // Hack to convert to array, its a lot easier to chunk with arrays
        $json = json_encode($xml);
        $data = json_decode($json, true);

        return view('outdoor-furniture-cleveland', compact('data'));
    }


    /**
     * @param $page
     * @param $slug
     *
     * @return mixed
     */
    public function outdoorFurnitureClevelandIndividual($page, $slug)
    {
        $xmlFile = app_path() . '/xml/perfect-patios-decks.xml';

        $xml = simplexml_load_file($xmlFile);

        // Hack to convert to array, its a lot easier to chunk with arrays
        $json = json_encode($xml);
        $data = json_decode($json, true);
        foreach ($data['Gallery'] as $gallery) {
            if ($gallery['ID'] == $page) {
                $galleryTitle       = $gallery['Title'];
                $galleryDescription = $gallery['Description'];
                $galleryPhotos      = $gallery['Photos']['Photo'];
            }
        }

        return view('cleveland-patio-deck-furniture', compact('galleryTitle', 'galleryDescription', 'galleryPhotos', 'data', 'page'));
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
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();

        Mail::send('emails.send', ['data' => $data], function ($message) {
            
            $message->subject('Patio Deck & Hearth Contact Form');
            $message->from('admin@patiodeckhearth.com', 'Patio Deck & Hearth Contact Form');

            $message->to('tj@tjshafer.com');
            $message->cc('dpavlish@gmail.com');

        });

        return redirect()->route('contact')->withMessage('Thank you for contacting us. We will be in touch soon.');
    }

}
