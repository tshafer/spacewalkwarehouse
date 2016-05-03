<?php namespace Wash\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Wash\Attendee;
use Wash\ClassTime;
use Wash\FitClass;
use Wash\FitFest;
use Wash\Http\Controllers\Controller;

/**
 * @package Wash\Http\Controllers
 */
class FitFestsController extends Controller
{

    /**
     *
     */
    public function index()
    {
        $times = ClassTime::with('fitClass', 'Fitclass.Students')->get();

        return view('frontend.fitfest.index', compact('times'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email'      => 'required|email',
            'first_name' => 'required',
            'last_name'  => 'required',
        ]);

        if (count($request->get('class')) == 0) {
            flash('Please select at least one class');

            return redirect()->back()->withInput();
        }


        if ($request->has('class')) {
            foreach ($request->get('class') as $key => $id) {
                $class = FitClass::find($id);
                if($class->max_students - $class->students->count() == 0) {
                    flash("Sorry. $class->name is full. Please try again.");
                    return redirect()->back()->withInput();
                }
            }
        }

        $hasEvent = Attendee::where('email', $request->get('email'))->where('event_id', 6)->exists();

        if ( ! $hasEvent) {
            flash("Sorry, I can't find your ticket. <br/>Please use the email address you used when purchasing. Please try again and make sure you re-select your classes!.");

            return redirect()->back()->withInput();
        }

        $fitfest = FitFest::create($request->only(['first_name', 'last_name', 'email']));

        if ($request->has('class')) {
            foreach ($request->get('class') as $key => $id) {
                $class = FitClass::find($id);
                $fitfest->classes()->attach($class);
            }
            $fitfest->save();
        }

        if ($fitfest) {
            return redirect()->route('fitfest.thanks');
        }

        return view('frontend.fitfest.index');
    }


    /**
     *
     */
    public function thanks()
    {
        return view('frontend.fitfest.thanks');
    }


    /**
     *
     */
    public function export()
    {
        $classId = [2, 3, 4, 5, 6, 7, 8, 9, 10, 13, 14, 15, 16];
        $classes = FitClass::whereIn('id', $classId)->get();

        Excel::create('fitfest_2015_classes', function ($excel) use ($classes) {
            $excel->setTitle('Fit Fest Classes and Participants');
            $excel->setCompany('Washingtonian');

            foreach ($classes as $class) {
                $rows = [];
                if (strlen($class->name) > 31) {
                    $class->name = substr($class->name, 0, 28) . '...';
                }
                if ($class->students->count() > 0) {
                    foreach ($class->students as $key => $student) {
                        if ($student) {
                            $rows[] = [
                                $student->first_name,
                                $student->last_name,
                                $student->email,
                            ];
                        }
                    }
                }
                $excel->sheet(str_replace(':', ' ', $class->name), function ($sheet) use ($rows) {
                    $sheet->rows($rows);
                });
            }
        })->download('xlsx');
    }
}
