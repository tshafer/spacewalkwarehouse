<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Unit::class, 2)->create()->each(function ($unit) {
            $product = Product::orderBy(DB::raw('RAND()'))->take(1)->first();
            $product->units()->save($unit);
        });
    }
}
