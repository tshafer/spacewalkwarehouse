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
                @if(Cart::count() > 0)
                    <div class="col-lg-12 col-sm-12 hero-feature">

                        <div class="table-responsive">

                            <table class="table table-bordered tbl-cart">
                                <thead>
                                <tr>
                                    <td class="hidden-xs">Image</td>
                                    <td>Product Name</td>
                                    <td>Price</td>
                                    <td>Remove</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(Cart::content() as $unit)
                                    <tr>
                                        <td class="hidden-xs">
                                            @if($unit->options->image)
                                                <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                                    <img src="{{$unit->options->image}}"
                                                         alt="{{$unit->options->product_name}}" title=""
                                                         width="47" height="47"/>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                            - ({{$unit->options->width}} x {{$unit->options->length}}
                                            x {{$unit->options->height}}) - ({{$unit->options->weight}} LBS)
                                        </td>
                                        <td>${{$unit->price}}</td>
                                        <td class="text-center">
                                            {{open(['route' => ['cart.destroy',$unit->rowId], 'method' => 'delete'])}}
                                            <button type="submit" class="remove_cart btn btn-danger" rel="2">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            {{close()}}
                                        </td>
                                    </tr>
                                @endforeach


                                <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <td class="total" colspan="2"><b>${{Cart::subtotal()}}</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="btn-group btns-cart">
                            @if ($url = Session::get('backUrl'))
                                <a class="btn btn-primary" href="{{$url}}">
                                    <i class="fa fa-arrow-circle-left"></i> Continue Shopping</a>
                            @else
                                <a class="btn btn-primary" href="{{route('home')}}"><i class="fa fa-arrow-circle-left"></i> Continue Shopping</a>
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
