<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::roots()->get();

        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $nestedList = Category::getNestedList('name', null, '  > ');

        return view('admin.categories.create', compact('nestedList'));
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
            'name'       => 'required',
            'intro_text' => 'required',
        ]);

        if ($request->get('parent_category') == 0) {
            $category = Category::create($request->all());
            $category->makeRoot();
            $category->save();
        } else {
            $root     = Category::find($request->get('parent_category'));
            $category = $root->children()->create($request->all());
            $category->save();
        }

        flash('Category Added!');

        return redirect()->route('admin.categories.show', [$category->id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Category            $category
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, Request $request)
    {
        $category->fill($request->all());

        $category->save();

        flash('Category updated!');

        return redirect()->route('admin.categories.show', $category->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        flash('Category deleted!');

        return redirect()->route('admin.categories.index');
    }


    /**
     * @param $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveUp($category)
    {
        $category->moveLeft();

        flash("Category $category->name moved!");

        return redirect()->back();
    }


    /**
     * @param $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveDown($category)
    {
        $category->moveRight();

        flash("Category $category->name moved!");

        return redirect()->back();
    }
}
