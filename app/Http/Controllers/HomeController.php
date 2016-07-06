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

        return view('outdoor-furniture-cleveland', compact('xml'));
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

        foreach ($xml->Gallery as $gallery) {
            if ($gallery->ID == $page) {
                $galleryTitle       = $gallery->Title;
                $galleryDescription = $gallery->Description;
                $galleryPhotos      = $gallery->Photos->Photo;
            }
        }

        return view('cleveland-patio-deck-furniture', compact('galleryTitle', 'galleryDescription', 'galleryPhotos', 'xml', 'page'));
    }

}
