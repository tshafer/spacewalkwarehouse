@include('frontend.asktheexperts.common')

<div class="form-group">
    {!!label('Specialization')!!}
    {!!textarea('specialization',old('specialization'),['class' => 'form-control', 'data-limit' => '12', 'data-validation' => 'required']) !!}
</div>

<div class="form-group">
    {!!label('Designations, Affiliations & Awards')!!}
    {!!textarea('designations',old('designations'),['class' => 'form-control', 'data-limit' => '20', 'data-validation' => 'required']) !!}
</div>

<div class="form-group">
    {!!label('Ad Copy')!!}
    {!!textarea('body',old('body'),['class' => 'form-control', 'data-limit' => '100', 'data-validation' => 'required']) !!}
</div>

@include('frontend.asktheexperts.photo')
@include('frontend.asktheexperts.footer')