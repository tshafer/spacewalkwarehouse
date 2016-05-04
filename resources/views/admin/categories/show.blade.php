@extends('admin.layout')

@section('title') Category @stop

@section('subtitle') {{$category->name}} @stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Category Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.categories.edit', $category->id], 'fa-edit', 'Edit Category') !!}
                        {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Category') !!}
                    </div>
                </div>
                <h2>{{$category->name}}</h2>
                {!!$category->intro_text!!}<br/>
                <dl class="dl-horizontal">
                    <dt>Address</dt>
                    <dd>{!! $category->intro_text !!}</dd>
                    <br/>

                </dl>

            </div>

            <div class="block">
                <div class="block-title">
                    <h2>Sub Categories</h2>
                    <div class="block-options pull-right">
                        {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Sub Category') !!}
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="min">ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($category->children()->count() > 0)
                        @foreach($category->children()->get() as $child)
                            <tr>
                                <td>{{$child->id}}</td>
                                <td>{{$child->name}}</td>
                                <td class="min">
                                    {!!$child->getTableLinks()!!}
                                    @if($category->children()->count() > 1)
                                        <a href="{{route('admin.categories.moveup', $child->id)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                        <a href="{{route('admin.categories.movedown', $child->id)}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                There are no Sub Categories Available
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">


            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE CATEGORY', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop