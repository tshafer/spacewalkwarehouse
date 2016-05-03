<?php
namespace Wash\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Wash\FitFest;
use Wash\Http\Controllers\Controller;

class FitFestsController extends Controller
{

    /**

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fitfests = (new FitFest());

        if ($column = Input::get('sort_by')) {
            $fitfests = $fitfests->orderBy($column, Input::get('dir', 'asc'));
        }

        $fitfests = $fitfests->paginate();

        return view('admin.fitfest.index', compact('fitfests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  FitFest $fitfests
     *
     * @return Response
     */
    public function show(FitFest $fitfests)
    {
        return view('admin.fitfest.show', compact('fitfests'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param FitFest $fitfest
     *
     * @return Response
     */

    public function destroy(FitFest $fitfest)
    {

        $fitfest->delete();

        flash('Submission Deleted Successfully');

        return redirect()->back();
    }
}
