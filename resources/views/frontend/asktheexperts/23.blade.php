@include('frontend.asktheexperts.common')

<div class="form-group">
    {!!label('Specialization')!!}
    {!!text('specialization',old('specialization'),['class' => 'form-control', 'data-limit' => '20', 'data-validation' => 'required']) !!}
</div>

<div class="form-group">
    {!!label('Designations, Affiliations & Awards')!!}
    {!!text('designations',old('designations'),['class' => 'form-control', 'data-limit' => '25', 'data-validation' => 'required']) !!}
</div>

<div class="form-group">
    {!!label('Ad Copy')!!}
    {!!textarea('body',old('body'),['class' => 'form-control', 'data-limit' => '180', 'data-validation' => 'required']) !!}
</div>

@include('frontend.asktheexperts.photo')
@include('frontend.asktheexperts.footer')