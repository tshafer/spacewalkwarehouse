@extends('layout')

@section('title', $product->name)

@section('content')

    <div class="container main-container">
        <div class="row">

            <!-- Product Detail -->
            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">{{$product->name}}</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">

                    <div class="row">
                        <div class="col-md-8">

                            <ul id="imageGallery">
                                @foreach ($product->media as $photo)
                                    <li data-thumb="{{$photo->getUrl('thumb') }}" data-src="{{$photo->getUrl('full') }}"><img
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
                                    <form>
                                        <div class="the-list">
                                            <h3 class="col-xs-12">
                                                {{$product->price}}
                                            </h3>
                                        </div>

                                        <div class="the-list">
                                            <div class="col-xs-4">Select</div>
                                            <div class="col-xs-8">
                                                <select class="form-control">
                                                    <option value="">Select Option</option>
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="the-list">
                                            <div class="col-xs-4">Checkbox</div>
                                            <div class="col-xs-8">
                                                <label>
                                                    <input type="checkbox" value="check1"> Check 1
                                                </label>&nbsp;
                                                <label>
                                                    <input type="checkbox" value="check2" checked> Check 2
                                                </label>
                                            </div>
                                        </div>
                                        <div class="the-list">
                                            <div class="col-xs-4">Radio</div>
                                            <div class="col-xs-8">
                                                <label>
                                                    <input type="radio" name="radio" value="radio1" checked> Radio 1
                                                </label>&nbsp;
                                                <label>
                                                    <input type="radio" name="radio" value="radio2"> Radio 2
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr/>
                                        <div class="col-xs-12 input-qty-detail">
                                            <input type="text" class="form-control input-qty text-center" value="1">
                                            <button class="btn btn-default pull-left"><i
                                                        class="fa fa-shopping-cart"></i> Add to Cart
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>
                                    </form>
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
