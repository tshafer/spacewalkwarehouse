<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }


    /**
     * @param \App\Product $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id')->toArray();

        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        $parentId = $product->categories()->first();

        return view('admin.products.edit', compact('product', 'manufacturers', 'nestedList', 'parentId'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id')->toArray();

        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        $parentId = $request->has('cat') ? $request->get('cat') : null;

        return view('admin.products.create', compact('manufacturers', 'nestedList', 'parentId'));
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
        $rules   = [
            'name' => 'bail|required|unique:products',
        ];
        $product = $this->runSave($request, $rules);

        flash('Product Added!');

        return redirect()->route('admin.products.show', [$product->id]);
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
        $product = Product::create($request->all());

        if ($request->has('enabled')) {
            $product->enabled = true;
        } else {
            $product->enabled = false;
        }

        if ($request->has('categories')) {
            $product->categories()->detach();
            foreach ($request->get('categories') as $category) {
                $categoryModel = Category::whereId($category)->first();
                $product->categories()->attach($categoryModel);
            }
        }

        if ($request->has('manufacturers')) {
            $product->manufacturers()->detach();
            foreach ($request->get('manufacturers') as $manufacturer) {
                $manufacturerModel = Manufacturer::whereId($manufacturer)->first();
                $product->manufacturers()->attach($manufacturerModel);
            }
        }

        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))->preservingOriginal()->toCollection('products');
        }

        $product->save();

        return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request)
    {
        $rules = [
            'name' => 'bail|required|unique:products,id,:id',
        ];

        $this->runUpdate($request, $rules, $product);

        flash('Product updated!');

        return redirect()->route('admin.products.show', $product->id);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Product             $product
     *
     * @return \App\Manufacturer|static
     */
    protected function runUpdate(Request $request, array $rules, Product $product)
    {
        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));

        $product->fill($request->except('enabled'));

        if ($request->has('enabled')) {
            $product->enabled = true;
        } else {
            $product->enabled = false;
        }

        if ($request->has('categories')) {
            $product->categories()->detach();
            foreach ($request->get('categories') as $category) {
                $categoryModel = Category::whereId($category)->first();
                $product->categories()->attach($categoryModel);
            }
        }

        if ($request->has('manufacturers')) {
            $product->manufacturers()->detach();
            foreach ($request->get('manufacturers') as $manufacturer) {
                $manufacturerModel = Manufacturer::whereId($manufacturer)->first();
                $product->manufacturers()->attach($manufacturerModel);
            }
        }

        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))->preservingOriginal()->toCollection('products');
        }

        $product->save();

        return $product;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();

        flash('Product deleted!');

        return redirect()->route('admin.products.index');
    }


    /**
     * @param \App\Product      $product
     * @param                   $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Product $product, $imageId)
    {
        $product->deleteMedia($imageId);

        return redirect()->back();
    }

}
