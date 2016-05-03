<div class="form-bordered">

    <div class="form-group">
        {!! label('email') !!}
        {!! email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! label('first_name') !!}
        {!! text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! label('last_name') !!}
        {!! text('last_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! label('password') !!}
        {!! password('password',['class' => 'form-control']) !!}
    </div>

    {{--<div class="form-group">--}}
    {{--{!! label('admin') !!}--}}
    {{--{!! checkbox('admin') !!}--}}
    {{--</div>--}}

    <div class="form-group form-actions">
        {!! submit('Save User', ['class' => 'btn btn-success']) !!}
    </div>
</div>
