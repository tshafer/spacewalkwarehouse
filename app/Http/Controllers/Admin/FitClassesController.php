<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\FitClass;
use App\Http\Controllers\Controller;

class FitClassesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $classes = (new FitClass())->with('students');

        if ($column = Input::get('sort_by')) {
            $classes = $classes->orderBy($column, Input::get('dir', 'asc'));
        }

        $classes = $classes->get();

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  FitClass $fitclass
     *
     * @return Response
     */
    public function show(FitClass $fitclass)
    {
        $students = $fitclass->students;

        if ($column = Input::get('sort_by')) {
            $students->sortBy(function ($model) use ($column) {
                return $model->$column;
            });
            if (Input::get('dir', 'asc') == 'desc') {
                $students = $students->reverse();
            }
        }

        return view('admin.classes.show', compact('fitclass', 'students'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param FitClass $fitclass
     *
     * @return Response
     */

    public function destroy(FitClass $fitclass)
    {

        $fitclass->delete();

        flash('Class Deleted Successfully');

        return redirect()->back();
    }
}
