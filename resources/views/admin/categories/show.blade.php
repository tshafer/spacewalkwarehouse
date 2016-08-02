@extends('admin.layout')

@section('title') Category @stop

@section('subtitle')
    @if($category->parent && $category->parent->count())
        <a href="{{route('admin.categories.show',$category->parent()->first()->id) }}"> {!! $category->parent()->first()->name!!}</a> >
    @endif
    {{$category->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Category Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.categories.edit', $category->id], 'fa-edit', 'Edit Category') !!}
                        @if($category->isRoot())
                            {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Category') !!}
                        @endif
                    </div>
                </div>
                <h3>{{$category->name}}</h3>
                <table class="table table-striped table-hover">

                    @if($category->parent && $category->parent->count())
                        <tr>
                            <td>Parent Category</td>
                            <td colspan=2">
                                @foreach($category->parent()->get() as $parent)
                                    <a href="{{route('admin.categories.show',$parent->id) }}"> {!! $parent->name!!}</a>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Enabled</td>
                        <td colspan=2">{!! $category->is_enabled!!}</td>
                    </tr>
                    <tr>
                        <td> Intro Text</td>
                        <td colspan=2">{!! $category->intro_text!!}</td>
                    </tr>


                    @if($category->media->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{url('/')}}{!! $category->media->first()->getUrl('adminThumb')!!}"/><br/>

                            </td>
                            <td>
                                <a href="{{ route('admin.categories.image.delete',[$category->id, $category->media->first()->id]) }}"
                                   class="btn btn-warning btn-sm del"">Remove </a>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>


            @if($category->products->count() > 0)
                <div class="block">
                    <div class="block-title">
                        <h2>Products </h2>
                        <div class="block-options pull-right">
                            {!! toolbar_link(['admin.products.create', 'cat='.$category->id], 'fa-plus', 'New Product') !!}
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="min">ID</th>
                            <th>Name</th>
                            <th>Enabled</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($category->products->count() > 0)
                            @foreach($category->products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->is_enabled}}</td>
                                    <td>
                                        @if($product->media->count() > 0)
                                            <img src="{{url('/')}}{!! $product->media->first()->getUrl('adminThumb')!!}"/>
                                        @endif
                                    </td>
                                    <td class="min">
                                        {!!$product->getTableLinks()!!}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    There are no Products Available
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE CATEGORY', ['class' => 'btn btn-block btn-danger del']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop