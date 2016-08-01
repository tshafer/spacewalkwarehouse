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
        factory(App\Product::class, 1000)->create()->each(function ($product) {
            $categoryModel = Category::orderBy(DB::raw('RAND()'))->take(1)->first();
            $product->categories()->attach($categoryModel);
            $product->save();

            for ($i = 0; $i < rand(5,15); $i++) {
                $product->addMediaFromUrl('http://res.cloudinary.com/spacewalk/image/upload/e_trim,w_650/78a791f3b0b2b57c185b9e72ef1b421a.jpg')->preservingOriginal()->toCollection('products');
            }
            $product->save();
        });
    }
}
