<div class="form-group">
    {!!label('Photo Provided')!!}
    {!!file_input('photo', ['class' => 'form-control', 'data-validation' => 'mime size', 'data-validation-max-size' => '3M',  'data-validation-allowing' => 'jpg, png, gif' ])!!}
    <p class="help-block">color, 300 dpi, horizontal. Photo goes across gutter (please be conscious of this)</p>
</div>
<div class="form-group">
    {!!label('Names of people in photo (left to right)')!!}
    {!!text('peoples_names',old('peoples_names'),['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! label('Need photo taken?',null,['style' => 'font-size:20px']) !!}<br/>

    <div class="form-group">
        {!! label('Contact Name') !!}
        {!!text('need_name',old('need_name'),['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! label('Phone') !!}
        {!!text('need_phone',old('need_phone'),['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! label('Email') !!}
        {!!text('need_email',old('need_email'),['class' => 'form-control']) !!}
    </div>
</div>