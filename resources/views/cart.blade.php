@extends('layout')

@section('title', 'Cart')

@section('content')

    <div class="container main-container">
        <div class="row">
            @include('flash::messages')
            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">SHOPPING CART</span>
                </div>
                @if(Cart::instance(session('cartId'))->count() > 0)
                    <div class="col-lg-12 col-sm-12 hero-feature">
                        <table class="table table-bordered tbl-cart cart table-hover table-condensed">
                            <thead>
                            <tr>
                                <td>Product</td>
                                <td>Price</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(Cart::instance(session('cartId'))->content() as $unit)
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs">
                                                @if($unit->options->image)
                                                    <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                                        <img src="{{$unit->options->image}}"
                                                             alt="{{$unit->options->product_name}}" title=""
                                                             width="47" height="47"/>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-sm-10">
                                                <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                                - ({{$unit->options->width}} x {{$unit->options->length}}
                                                x {{$unit->options->height}}) - ({{$unit->options->weight}} LBS)
                                            </div>
                                        </div>
                                    </td>

                                    <td data-th="Price" class="text-center">${{$unit->price}}</td>
                                    <td class="actions text-center" data-th="">
                                        {{open(['route' => ['cart.destroy',$unit->rowId], 'method' => 'delete'])}}
                                        <button type="submit" class="remove_cart btn btn-danger btn-sm" rel="2">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        {{close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="hidden-xs"></td>
                                <td class="total text-center">Total <b>${{Cart::instance(session('cartId'))->subtotal()}}</b>
                                <td class="hidden-xs"></td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="btn-group btns-cart">
                            @if ($url = Session::get('backUrl'))
                                <a class="btn btn-primary" href="{{$url}}">
                                    <i class="fa fa-arrow-circle-left"></i> Continue Shopping</a>
                            @else
                                <a class="btn btn-primary" href="{{route('home')}}"><i
                                            class="fa fa-arrow-circle-left"></i> Continue Shopping</a>
                            @endif
                            <a class="btn btn-primary" href="{{route('checkout.index')}}">Checkout
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                        @else
                            <div class="col-md-12">
                                Your cart seems to be empty. Try adding some items.
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@stop
