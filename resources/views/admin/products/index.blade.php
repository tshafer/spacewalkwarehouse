@extends('admin.layout')

@section('title') Products @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.products.create', 'fa-plus', 'New Product') !!}
            </div>
            <h2>Products</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($products->count() > 0)
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->is_enabled}}</td>
                        <td>
                            @if($product->categories->count() > 0)
                                @foreach($product->categories as $category)
                                    <a href="{{route('admin.categories.show', $category->id)}}">{{ $category->name }}</a>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {!! defaultProductImage($product, 'thumb') !!}
                        </td>
                        <td class="min">
                            {!!$product->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no Products Available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! paginate($products) !!}
    </div>
@stop