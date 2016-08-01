@extends('layout')

@section('title', 'Checkout')

@section('content')


    <div class="container main-container">
        <div class="row">
            @include('flash::messages')
            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">CHECKOUT</span>
                </div>
                {{open(['route' => 'checkout.store'])}}
                <div class="col-md-12 hero-feature">

                    <div class="row form-group">
                        <div class="col-md-6">
                            {{ label('first_name')}}
                            {{ input('first_name','first_name', old('first_name'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ label('last_name')}}
                            {{ input('last_name','last_name', old('company_website'), ['class' => 'form-control','required']) }}
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-6">
                            {{ label('company_name')}}
                            {{ input('company_name','company_name', old('company_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ label('company_website')}}
                            {{ input('company_website','company_website', old('company_website'), ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            {{ label('email') }}
                            {{ input('email','email', old('email'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ label('Phone')}}
                            {{ input('phone','phone', old('telephone'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('message') }}
                            {{ textarea('message', old('message'), ['class' => 'form-control', 'rows' => 5, 'max-length' => 1000]) }}
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <table class="table table-bordered cart tbl-cart table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>Product</td>
                            <td>Price</td>
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

                                <td data-th="Price" class="text-center">
                                    ${{$unit->price}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="hidden-xs"></td>
                            <td class="total text-center">Total <b>${{Cart::instance(session('cartId'))->subtotal()}}</b>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="btn-group btns-cart pull-right">
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </div>
                        </div>
                    </div>

                </div>
                {{close()}}
            </div>
        </div>
    </div>
@stop
