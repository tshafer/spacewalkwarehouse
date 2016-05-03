@extends('admin.layout')

@section('title', 'Reports - YTD')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Author</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $author => $data)
                <tr>
                    <td>
                        {{ $author }}
                    </td>
                    <td>
                        <table class="table table-striped table-bordered">
                            @foreach($data as $month => $items)
                                <tr>
                                    <td><b>{{ date("F", mktime(0, 0, 0, $month, 10)) }}</b></td>
                                    <td><b>Views</b></td>
                                </tr>
                                @foreach($items as $item)
                                    <tr>
                                        <td style="width: 800px;"><b>( {{ $author }})</b> <a href="http://washingtonian.com{{ $item[2] }}" target="_blank">{{ $item[2] }}</a></td>
                                        <td>{{ $item[4]}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $results->render() !!}
@stop