@extends('layout')

@section('title', 'Cart')

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.flash')
                <span class="title">SHOPPING CART</span>
                @if(Cart::instance(session('cartId'))->count() > 0)
                    <table class="table table-bordered tbl-cart cart table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>Product</td>
                            <td>Grade</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach(Cart::instance(session('cartId'))->content() as $unit)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                                            @if($unit->options->image)
                                                <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                                    <img src="{{$unit->options->image}}"
                                                         alt="{{$unit->options->product_name}}"
                                                         title="{{$unit->options->product_name}}" class="img-responsive"/>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="cart-info">
                                                <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                                <div>
                                                    ({{$unit->options->width ?: 'N/A'}} x {{$unit->options->length ?: 'N/A'}}
                                                    x {{$unit->options->height ?: 'N/A'}}) - ({{$unit->weight .' LBS' ?: 'N/A'}})
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{$unit->options->grade ?: 'N/A'}}
                                </td>

                                <td class="actions text-center">
                                    {{Form::open(['route' => ['cart.destroy',$unit->rowId], 'method' => 'delete'])}}
                                    <button type="submit" class="remove_cart btn btn-danger btn-sm" rel="2">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div class="btn-group btns-cart">
                        @if ($url = Session::get('backUrl'))
                            <a class="btn btn-primary" href="{{$url}}">
                                <i class="fa fa-arrow-circle-left"></i> Continue Shopping
                            </a>
                        @else
                            <a class="btn btn-primary" href="{{route('home')}}"><i class="fa fa-arrow-circle-left"></i> Continue Shopping
                            </a>
                        @endif
                        <a class="btn btn-primary" href="{{route('checkout.index')}}">Checkout
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                @else
                    Your cart seems to be empty. Try adding some items.
                @endif
            </div>
        </div>
    </div>
@stop
