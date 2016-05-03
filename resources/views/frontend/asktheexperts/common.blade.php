<div class="form-group">
    {!!label('First Name')!!}
    {!!text('first_name', old('first_name'),['class' => 'form-control', 'data-validation' => 'required'] )!!}
</div>

<div class="form-group">
    {!!label('Last Name')!!}
    {!!text('last_name',old('last_name'),['class' => 'form-control', 'data-validation' => 'required'])!!}
</div>
<div class="form-group">
    {!!label('Headline')!!}
    {!!text('headline',old('headline'),['class' => 'form-control', 'data-validation' => 'required'])!!}
</div>
<div class="form-group">
    {!!label('Sub Headline')!!}
    {!!text('sub_headline',old('sub_headline'),['class' => 'form-control', 'data-validation' => 'required'])!!}
</div>
<div class="form-group">
    {!!label('Phone')!!}
    {!!text('phone',old('phone'),['class' => 'form-control phone', 'data-validation' => 'required'])!!}
</div>
<h4>First Address</h4>
<div class="form-group">
    {!!label('Address')!!}
    {!!text('address',old('address'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('Address 2')!!}
    {!!text('address_2',old('address_2'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('City')!!}
    {!!text('city',old('city'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('State')!!}
    {!!state_select()!!}
</div>
<div class="form-group">
    {!!label('Zip')!!}
    {!!text('zip',old('zip'),['class' => 'form-control'])!!}
</div>
<h4>Second Address</h4>
<div class="form-group">
    {!!label('Address')!!}
    {!!text('address2_1',old('address2_1'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('Address')!!}
    {!!text('address2_2',old('address2_2'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('City')!!}
    {!!text('address2_city',old('address2_city'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('State')!!}
    {!!state_select('address2_state')!!}
</div>
<div class="form-group">
    {!!label('Zip')!!}
    {!!text('address2_zip',old('address2_zip'),['class' => 'form-control'])!!}
</div>
<h4>Third Address</h4>
<div class="form-group">
    {!!label('Address')!!}
    {!!text('address3_1',old('address3_1'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('Address')!!}
    {!!text('address3_2',old('address3_2'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('City')!!}
    {!!text('address3_city',old('address3_city'),['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!!label('State')!!}
    {!!state_select('address3_state')!!}
</div>
<div class="form-group">
    {!!label('Zip')!!}
    {!!text('address3_zip',old('address3_zip'),['class' => 'form-control'])!!}
</div>
<h4>Information</h4>
<div class="form-group">
    {!!label('Website')!!}
    {!!text('website',old('website'),['class' => 'form-control'])!!}
</div>