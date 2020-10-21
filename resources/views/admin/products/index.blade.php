@extends('admin.layout')

@section('title') Products @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.products.create', 'fa-plus', 'New Product') !!}
            </div>
            <h2>Products</h2> <a href="{{route('admin.products.index')}}">All</a> | <a
                    href="{{route('admin.products.index', 'featured=true')}}">Featured</a> |
            {!! Form::select('category',  $categories->pluck('name', 'id'), Request::has('category') ? Request::get('category') : null, ['id' => 'category', 'placeholder' => 'Choose']) !!}
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Featured</th>
                <th>Category</th>
                <th style="text-align:center;">Image</th>
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
                        <td>{{$product->is_featured}}</td>
                        <td>
                            <a href="{{route('admin.categories.show', $product->categories->id)}}">{{ $product->categories->name }}</a>
                        </td>
                        <td>
                            {!! defaultProductImage($product, 'thumb', 'admin', 200) !!}
                        </td>
                        <td class="min">
                            {!!$product->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">
                        There are no Products Available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#category").change(function () {
                window.location = '/admin/products/?category=' + this.value
            });
        });
    </script>
@endsection
