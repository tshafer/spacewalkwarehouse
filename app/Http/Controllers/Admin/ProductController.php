<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use League\Fractal;
use League\Fractal\Manager;

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

        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        asort($nestedList);

        $parentId = $product->categories()->first();
        $parentId = isset($parentId) ? $parentId->id : null;

        return view('admin.products.edit', compact('product', 'nestedList', 'parentId'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        asort($nestedList);

        $parentId = $request->has('cat') ? $request->get('cat') : null;

        return view('admin.products.create', compact('nestedList', 'parentId'));
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
        dd($request->all());
        $this->runUpdate($request, $rules, $product);

        flash('Product updated!');

        return redirect()->route('admin.products.show', $product->id);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Product             $product
     *
     * @return static
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
    public function deleteImage(Product $product, Request $request)
    {
        dd($request->all());
        //$product->deleteMedia($imageId);

        return response()->json(['success' => 'true']);
    }



    /**
     * @param \Illuminate\Http\Request $request
     */
    public function addImage(Request $request)
    {
        $product = Product::find(Input::get('productId'));

        if ($request->hasFile('qqfile')) {
            $product->addMedia($request->file('qqfile'))->preservingOriginal()->toCollection('products');
        }

        return response()->json(['success' => 'true']);
    }


    /**
     * @param \App\Product $product
     *
     * @return \Illuminate\Support\Collection
     */
    public function loadImages(Product $product)
    {
        $images = $product->getMedia('products');

        $fractal = new Manager();

        $resource = new Fractal\Resource\Collection($images, function ($image) use ($product, $images) {
            return [
                'uuid'               => (int)$image->id,
                'name'               => $image->file_name,
                'size'               => $image->size,
                'deleteFileEndpoint ' => route('admin.products.images.delete', [$product->id]),
                'thumbnailUrl'       => $image->getUrl(),
            ];
        });

        $array = $fractal->createData($resource)->toArray();

        return json_encode($array['data']);
    }
}
