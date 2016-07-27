@extends('layout')

@section('title', 'Thank You')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container main-container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">THANK YOU</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">
                    Thank you for your request. We will be in touch soon.
                </div>
            </div>
        </div>
    </div>

@stop
