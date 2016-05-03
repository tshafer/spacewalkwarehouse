<?php
namespace Wash\Http\Controllers\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tshafer\Flash\Facades\FlashFacade;
use Wash\Http\Controllers\Controller;

class ReportsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ytdPageViews = Cache::get('getYTDPageviews');

        if ( ! $ytdPageViews) {

            return redirect()->to('/admin')->withStatus('No Reports Generated');
        }


        $results = $this->paginate($ytdPageViews);

        return view('admin.reports.index', compact('results'));
    }


    /**
     * Paginates a collection of results.
     *
     * @param Collection $results
     *
     * @return LengthAwarePaginator
     */
    protected static function paginate(Collection $results)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        $startIndex = ($currentPage * 10) - 10;
        $paginatedResults = Collection::make($results)->slice($startIndex, 10);

        return new LengthAwarePaginator(
          $paginatedResults,
          $results->count(),
          10,
          $currentPage,
          [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
          ]
        );
    }
}
