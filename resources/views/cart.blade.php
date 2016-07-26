@extends('layout')

@section('title', 'Contact Space Walk Online')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container main-container">
        <div class="row">

            <!-- Cart -->
            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">SHOPPING CART</span>
                </div>
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
                                            <a href="detail.html">
                                                <img src="{{$unit->options->image}}"
                                                     alt="{{$unit->options->product_name}}" title=""
                                                     width="47" height="47"/>
                                            </a>
                                        @endif
                                    </td>
                                    <td><a href="detail.html">{{$unit->options->product_name}}</a></td>
                                    <td>{{$unit->price}}</td>
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
                        <a class="btn btn-primary" href="{{route('home')}}"><i class="fa fa-arrow-circle-left"></i>
                            Continue Shopping</a>
                        <button type="button" class="btn btn-primary" onclick="window.location='checkout.html'">Checkout
                            <i class="fa fa-arrow-circle-right"></i></button>
                    </div>

                </div>
            </div>
            <!-- End Cart -->


        </div>
    </div>
@stop
