@extends('admin.layout')

@section('title') Categories @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Category') !!}
            </div>
            <h2>Categories</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th># SubCategories</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($categories->count() > 0)
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->is_enabled}}</td>
                        <td>{{$category->children()->count()}}</td>
                        <td>
                            @if($category->getMedia()->count() > 0)
                                <img src="{!! $category->getMedia('categories')->first()->getUrl('adminThumb')!!}"/>
                            @endif
                        </td>
                        <td class="min">
                            {!!$category->getTableLinks()!!}
                            @if($categories->count() > 1)
                                <a href="{{route('admin.categories.moveup', $category->id)}}"><i class="fa fa-arrow-up"
                                                                                                 aria-hidden="true"></i></a>
                                <a href="{{route('admin.categories.movedown', $category->id)}}"><i
                                            class="fa fa-arrow-down" aria-hidden="true"></i></a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no Categories Available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! paginate($categories) !!}
    </div>
@stop