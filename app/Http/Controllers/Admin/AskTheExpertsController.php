<?php namespace Wash\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Wash\AskTheExpert;
use Wash\Http\Controllers\Controller;


class AskTheExpertsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $asktheexperts = (new AskTheExpert());

        if ($column = Input::get('sort_by')) {
            $asktheexperts = $asktheexperts->orderBy($column, Input::get('dir', 'asc'));
        }

        $asktheexperts = $asktheexperts->paginate();

        return view('admin.asktheexperts.index', compact('asktheexperts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  AskTheExpert $asktheexpert
     *
     * @return Response
     */
    public function show(AskTheExpert $asktheexpert)
    {
        return view('admin.asktheexperts.show', compact('asktheexpert'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param AskTheExpert $asktheexpert
     *
     * @return Response
     */

    public function destroy(AskTheExpert $asktheexpert)
    {
        if (File::exists('uploads/asktheexperts/' . $asktheexpert->photo)) {
            File::delete('uploads/asktheexperts/' . $asktheexpert->photo);
        }

        $asktheexpert->delete();
        flash('Submission Deleted Successfully');

        return redirect()->route('admin.asktheexperts.index');
    }
}
