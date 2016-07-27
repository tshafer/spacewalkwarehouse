@extends('layout')

@section('title', $product->name)

@section('content')

    <div class="container main-container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">{{$product->name}}</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">

                    <div class="row">
                        <div class="col-md-8">

                            <ul id="imageGallery">
                                @foreach ($product->media as $photo)
                                    <li data-thumb="{{$photo->getUrl('thumb') }}"
                                        data-src="{{$photo->getUrl('full') }}"><img
                                                src="{{$photo->getUrl('thumb') }}"/></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="well product-short-detail">
                                <div class="row">
                                        <div class="the-list">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>W x L x H</th>
                                                    <th>UNIT LB</th>
                                                    <th>PRICE</th>
                                                    <th>BUY</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($product->units as $unit)
                                                    <tr>
                                                        <td>{{$unit->width}} x {{$unit->length}}
                                                            x {{$unit->height}}</td>
                                                        <td>{{$unit->weight}}</td>
                                                        <td>{{$unit->price}}</td>
                                                        <td>
                                                            {{open(['route' => 'cart.store'])}}
                                                            {{ hidden('unit', $unit->id) }}
                                                            <button type="submit" class="btn btn-primary btn-xs pull-left"><i
                                                                        class="fa fa-shopping-cart"></i> Add to Cart
                                                            </button>
                                                            {{close()}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br clear="all"/>

                        <div class="col-xs-12 product-detail-tab">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="detail.html#desc" data-toggle="tab">Description</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="desc">
                                    <div class="well">
                                        <p>{{$product->description}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
