<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $nestedList = Category::getNestedList('name', null, '  > ');

        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id')->toArray();

        if ($parentId = $category->parent()->first()) {
            $parentId = $parentId->id;
        }

        $manufacturerId = null;

        return view('admin.categories.edit', compact('category', 'nestedList', 'parentId', 'manufacturers', 'manufacturerId'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $nestedList = Category::getNestedList('name', null, '  > ');

        $parentId = $request->has('cat') ? $request->get('cat') : null;

        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id')->toArray();

        return view('admin.categories.create', compact('nestedList', 'parentId', 'manufacturers'));
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
        $rules = [
            'name' => 'bail|required|unique:categories',
        ];

        if ($request->has('manufacturers') && $request->get('parent_category') == 0) {
            flash('A main category can\'t have any manufacturers.');

            return redirect()->back()->withInput();

        }
        $category = $this->runSave($request, $rules);

        flash('Category Added!');

        return redirect()->route('admin.categories.show', [$category->id]);
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
            'title' => 'required',
        ], $rules));

        if ($request->get('parent_category') == 0) {
            $category = Category::create($request->all());
            $category->makeRoot();
        } else {
            $root     = Category::whereId($request->get('parent_category'))->first();
            $category = $root->children()->create($request->all());
        }

        if ($request->has('manufacturers')) {
            $category->manufacturers()->detach();
            foreach ($request->get('manufacturers') as $manufacturer) {
                $manufacturerModel = Manufacturer::whereId($manufacturer)->first();
                $category->manufacturers()->attach($manufacturerModel);
            }
        }

        if ($request->has('enabled')) {
            $category->enabled = true;
        } else {
            $category->enabled = false;
        }

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->preservingOriginal()->toCollection('categories');
        }

        $category->save();

        $this->clearMenuCache();

        return $category;
    }


    /**
     *
     */
    protected function clearMenuCache()
    {
        Cache::forget('menu');
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
        $rules = [
            'name' => 'bail|required|unique:categories,id,:id',
        ];

        if ($request->get('parent_category') == $category->id) {
            flash('You cant make a category a child of itself.');

            return redirect()->back()->withInput();
        }

        if ($request->get('parent_category') == 0 && $category->children()->count() > 0) {
            flash('You cant make a category that has children into a child. Please remove this categories children and try again.');

            return redirect()->back()->withInput();
        }

        $this->runUpdate($request, $rules, $category);

        flash('Category updated!');

        return redirect()->route('admin.categories.show', $category->id);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Category            $category
     *
     * @return \App\Category|static
     */
    protected function runUpdate(Request $request, array $rules, Category $category)
    {
        $this->validate($request, array_merge([
            'title' => 'required',
        ], $rules));

        if ($request->get('parent_category') == 0) {
            $category->makeRoot();
        } else {
            $root = Category::find($request->get('parent_category'));
            $category->makeChildOf($root);
        }

        $category->fill($request->except('parent_category', 'enabled'));

        if ($request->has('manufacturers')) {
            $category->manufacturers()->detach();
            foreach ($request->get('manufacturers') as $manufacturer) {
                $manufacturerModel = Manufacturer::whereId($manufacturer)->first();
                $category->manufacturers()->attach($manufacturerModel);
            }
        }

        if ($request->has('enabled')) {
            $category->enabled = true;
        } else {
            $category->enabled = false;
        }

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->preservingOriginal()->toCollection('categories');
        }

        $category->save();

        $this->clearMenuCache();

        return $category;
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
     * @param \App\Category $category
     * @param               $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Category $category, $imageId)
    {
        //$image = $category->getMedia()->whereLoose('id', $imageId)->first();
        $category->deleteMedia($imageId);

        return redirect()->back();
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
