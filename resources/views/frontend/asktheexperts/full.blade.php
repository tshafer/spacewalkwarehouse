@include('frontend.asktheexperts.common')
<div class="form-group">
    {!!label('Specialization')!!}
    {!!textarea('specialization',old('specialization'),['class' => 'form-control', 'data-limit' => '35', 'data-validation' => 'required']) !!}
</div>
<div class="form-group">
    {!!label('Designations, Affiliations & Awards')!!}
    {!!textarea('designations',old('designations'),['class' => 'form-control', 'data-limit' => '40', 'data-validation' => 'required']) !!}
</div>
<div class="form-group">
    {!!label('Ad Copy')!!}
    {!!textarea('body',old('body'),['class' => 'form-control', 'data-limit' => '250', 'data-validation' => 'required']) !!}
</div>
@include('frontend.asktheexperts.photo')
@include('frontend.asktheexperts.footer')