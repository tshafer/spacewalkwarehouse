@include('frontend.asktheexperts.common')

<div class="form-group">
    {!!label('Ad Copy')!!}
    {!!textarea('body',old('body'), ['class' => 'form-control', 'data-limit' => '50', 'data-validation' => 'required']) !!}

</div>

@include('frontend.asktheexperts.photo')
@include('frontend.asktheexperts.footer')