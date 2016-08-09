<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 100)->create()->each(function ($product) {
            $categoryModel = Category::orderBy(DB::raw('RAND()'))->take(1)->first();
            $product->categories()->attach($categoryModel);
            $product->save();

            for ($i = 0; $i < rand(1,8); $i++) {
                $product->addMediaFromUrl('http://res.cloudinary.com/spacewalk/image/upload/e_trim,w_650/78a791f3b0b2b57c185b9e72ef1b421a.jpg')->preservingOriginal()->toCollection('products');
            }
            $product->save();
        });
    }
}
