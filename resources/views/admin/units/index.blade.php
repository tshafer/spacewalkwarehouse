@extends('admin.layout')

@section('title') Units @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.units.create', 'fa-plus', 'New Unit') !!}
            </div>
            <h2>Units</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Name</th>
                <th>Product</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($units->count() > 0)
                @foreach($units as $unit)
                    <tr>
                        <td>{{$unit->id}}</td>
                        <td>{{$unit->name}}</td>
                        <td>
                            @if($unit->product)
                                <a href="{{route('admin.products.show', $unit->product->id)}}">{{ $unit->product->name }}</a>
                            @endif
                        </td>

                        <td class="min">
                            {!!$unit->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no units available.
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! $units->links() !!}
    </div>
@stop
