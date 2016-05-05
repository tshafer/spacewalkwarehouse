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
                        <td> Intro Text</td>
                        <td colspan=2">{!! $category->intro_text!!}</td>
                    </tr>
                    <tr>
                        <td> Title</td>
                        <td colspan=2">{!! $category->title!!}</td>
                    </tr>
                    <tr>
                        <td>Enabled</td>
                        <td colspan=2">{!! $category->is_enabled!!}</td>
                    </tr>
                    @if($category->manufacturers()->count() > 0)
                        <tr>
                            <td>Manufacturers</td>
                            <td colspan=2">
                                @foreach($category->manufacturers()->get() as $manufacturer)
                                    <a href="{{route('admin.manufacturers.show', $manufacturer->id)}}">{{ $manufacturer->name }}</a>
                                    @if(!$loop->last)
                                        |
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endif
                    @if($category->getMedia()->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{url('/')}}{!! $category->getMedia('categories')->first()->getUrl('adminThumb')!!}"/><br/>

                            </td>
                            <td>
                                <a href="{{ route('admin.categories.removeimage',[$category->id, $category->getMedia('categories')->first()->id]) }}"
                                   class="btn btn-warning btn-sm">Remove </a>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            @if($category->isRoot())
                <div class="block">
                    <div class="block-title">
                        <h2>Sub Categories</h2>
                        <div class="block-options pull-right">
                            {!! toolbar_link(['admin.categories.create', 'cat='.$category->id], 'fa-plus', 'New Sub Category') !!}
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="min">ID</th>
                            <th>Name</th>
                            <th>Enabled</th>
                            <th># Products</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($category->children()->count() > 0)
                            @foreach($category->children()->get() as $child)
                                <tr>
                                    <td>{{$child->id}}</td>
                                    <td>{{$child->name}}</td>
                                    <td>{{$child->is_enabled}}</td>
                                    <td>
                                        {{$child->products()->count() }}
                                    </td>
                                    <td>
                                        @if($child->getMedia()->count() > 0)
                                            <img src="{{url('/')}}{!! $child->getMedia('categories')->first()->getUrl('adminThumb')!!}"/>
                                        @endif
                                    </td>
                                    <td class="min">
                                        {!!$child->getTableLinks()!!}
                                        @if($category->children()->count() > 1)
                                            @if(!$loop->first)
                                                <a class="btn btn-xs btn-warning"
                                                   href="{{route('admin.categories.moveup', $child->id)}}"><i
                                                            class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                            @endif
                                            @if(!$loop->last)
                                                <a class="btn btn-xs btn-warning"
                                                   href="{{route('admin.categories.movedown', $child->id)}}"><i
                                                            class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                            @endif
                                        @endif
                                        <a class="btn btn-xs btn-warning"
                                           href="{{route('subcategory', [$category->slug, $child->slug])}}"
                                           target="_blank">
                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    There are no Sub Categories Available
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            @endif

            @if(!$category->isRoot())
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
                                @foreach($category->products()->get() as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->is_enabled}}</td>
                                        <td>
                                            @if($product->getMedia()->count() > 0)
                                                <img src="{{url('/')}}{!! $product->getMedia('products')->first()->getUrl('adminThumb')!!}"/>
                                            @endif
                                        </td>
                                        <td class="min">
                                            {!!$product->getTableLinks()!!}
                                            <a class="btn btn-xs btn-warning"
                                               href="{{route('product', [$category->parent()->first()->slug, $category->slug, $product->slug])}}"
                                               target="_blank">
                                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                            </a>
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
            @endif
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