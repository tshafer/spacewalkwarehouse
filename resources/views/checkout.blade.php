@extends('layout')

@section('title', 'Checkout')

@section('content')


    <div class="container main-container">
        <div class="row">
            @include('flash::messages')
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">CHECKOUT</span>
                </div>
                {{open(['route' => 'checkout.store'])}}
                <div class="col-md-12 hero-feature">

                    <div class="row form-group">
                        <div class="col-md-6">
                            {{ label('First Name')}}
                            {{ input('first_name','first_name', old('first_name'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ label('Last Name')}}
                            {{ input('last_name','last_name', old('last_name'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            {{ label('email') }}
                            {{ input('email','email', old('email'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ label('Telephone')}}
                            {{ input('phone','phone', old('telephone'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('address') }}
                            {{ textarea('address', old('address'), ['class' => 'form-control', 'rows' => 5, 'required']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            {{ label('city')}}
                            {{ input('city','city', old('city'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-4">
                            {{ label('state')}}
                            {{ state_select('state', old('state'), ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-md-4">
                            {{ label('zip')}}
                            {{ input('zip','zip', old('zip'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('comment') }}
                            {{ textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => 5, 'required']) }}
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered tbl-cart">
                            <thead>
                            <tr>
                                <td class="hidden-xs">Image</td>
                                <td>Product Name</td>
                                <td>Price</td>
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
                                        <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a> - ({{$unit->options->width}} x {{$unit->options->length}} x {{$unit->options->height}}) - ({{$unit->options->weight}} LBS)
                                    </td>
                                    <td>${{$unit->price}}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2" align="right">Total</td>
                                <td class="total" colspan="2"><b>${{Cart::subtotal()}}</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
