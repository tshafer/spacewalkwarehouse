<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Special;
use Illuminate\Http\Request;

class SpecialsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specials = Special::all();

        return view('admin.specials.index', compact('specials'));
    }


    /**
     * Display the specified resource.
     *
     * @param Special $special
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Special $special)
    {
        return view('admin.specials.show', compact('special'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Special $special
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Special $special)
    {
        return view('admin.specials.edit', compact('special'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.specials.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required',
        ]);

        $special = Special::create($request->all());

        if ($request->hasFile('image')) {
            $special->addMedia($request->file('image'))->preservingOriginal()->toCollection('specials');
        }

        $special->save();

        flash('Special Added!');

        return redirect()->route('admin.specials.show', [$special->id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Special             $special
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Special $special, Request $request)
    {

        $this->validate($request, [
            'title' => 'bail|required',
        ]);

        $special->fill($request->except('enabled'));

        $special->clearMediaCollection();

        if ($request->hasFile('image')) {
            $special->addMedia($request->file('image'))->preservingOriginal()->toCollection('specials');
        }

        $special->save();

        flash('Special updated!');

        return redirect()->route('admin.specials.show', $special->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Special $special
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Special $special)
    {
        $special->delete();

        flash('Special deleted!');

        return redirect()->route('admin.specials.index');
    }


    /**
     * @param \App\Special  $special
     * @param               $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Special $special, $imageId)
    {
        $special->deleteMedia($imageId);

        return redirect()->back();
    }

}
