<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();

        return view('admin.manufacturers.index', compact('manufacturers'));
    }


    /**
     * @param \App\Manufacturer $manufacturer
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.show', compact('manufacturer'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Manufacturer $manufacturer
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.manufacturers.create');
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
        $rules        = [
            'name' => 'bail|required|unique:manufacturers',
        ];
        $manufacturer = $this->runSave($request, $rules);

        flash('Manufacturer Added!');

        return redirect()->route('admin.manufacturers.show', [$manufacturer->id]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     *
     * @return static
     */
    protected function runSave(Request $request, array $rules)
    {
        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));
        $manufacturer = Manufacturer::create($request->all());

        if ($request->has('enabled')) {
            $manufacturer->enabled = true;
        } else {
            $manufacturer->enabled = false;
        }

        if ($request->hasFile('image')) {
            $manufacturer->addMedia($request->file('image'))->preservingOriginal()->toCollection('manufacturers');
        }

        $manufacturer->save();

        return $manufacturer;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Manufacturer        $manufacturer
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Manufacturer $manufacturer, Request $request)
    {
        $rules = [
            'name' => 'bail|required|unique:manufacturers,id,:id',
        ];

        $this->runUpdate($request, $rules, $manufacturer);

        flash('Manufacturer updated!');

        return redirect()->route('admin.manufacturers.show', $manufacturer->id);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Manufacturer        $manufacturer
     *
     * @return \App\Manufacturer|static
     */
    protected function runUpdate(Request $request, array $rules, Manufacturer $manufacturer)
    {
        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));

        $manufacturer->fill($request->except('enabled'));

        if ($request->has('enabled')) {
            $manufacturer->enabled = true;
        } else {
            $manufacturer->enabled = false;
        }

        if ($request->hasFile('image')) {
            $manufacturer->addMedia($request->file('image'))->preservingOriginal()->toCollection('manufacturers');
        }

        $manufacturer->save();

        return $manufacturer;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Manufacturer $manufacturer
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {

        $manufacturer->delete();

        flash('Manufacturer deleted!');

        return redirect()->route('admin.manufacturers.index');
    }


    /**
     * @param \App\Manufacturer $manufacturer
     * @param                   $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Manufacturer $manufacturer, $imageId)
    {
        $manufacturer->deleteMedia($imageId);

        return redirect()->back();
    }

}
