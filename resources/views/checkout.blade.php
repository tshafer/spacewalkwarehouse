@extends('layout')

@section('title', 'Checkout')

@section('content')

    <div class="container main-container">
        {{Form::open(['route' => 'checkout.store'])}}
        <div class="row">
            @include('partials.flash')
            <div class="col-md-12">
                <span class="title">CHECKOUT</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 hero-feature">

                <div class="row form-group">
                    <div class="col-md-6">
                        {{ Form::label('first_name')}} <span class="red">*</span>
                        {{ Form::input('first_name','first_name', old('first_name'), ['class' => 'form-control', 'required']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('last_name')}} <span class="red">*</span>
                        {{ Form::input('last_name','last_name', old('company_website'), ['class' => 'form-control','required']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        {{ Form::label('branch_name')}}
                        {{ Form::input('branch_name','branch_name', old('branch_name'), ['class' => 'form-control']) }}
                    </div>

                </div>


                <div class="row form-group">
                    <div class="col-md-12">
                        {{ Form::label('reason_for_request') }}
                        {{ Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => 5, 'max-length' => 1000]) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered cart tbl-cart table-hover table-condensed">
                    <thead>
                    <tr>
                        <td>Product</td>
                        <td>Grade</td>
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
                                                <img src="{{$unit->options->image}}" alt="{{$unit->options->product_name}}" title="{{$unit->options->product_name}}" class="img-responsive"/>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div class="cart-info">
                                            <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                            <div>
                                                - ({{$unit->options->width ?: 'N/A'}} x {{$unit->options->length ?: 'N/A'}}
                                                x {{$unit->options->height ?: 'N/A'}}) - ({{$unit->options->weight . 'LBS' ?: 'N/A'}} )
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                {{$unit->options->grade ?:'N/A'}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="btn-group btns-cart pull-right">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>
@stop
