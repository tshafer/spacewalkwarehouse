<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Manufacturer</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('description') !!}
                {!! textarea('description', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                @if(isset($manufacturer) &&  $manufacturer->getMedia('manufacturers')->first())
                    <img src="{!! $manufacturer->getMedia('manufacturers')->first()->getUrl('adminThumb')!!}"/><br/>
                @endif
                {!! label('image') !!}
                {!! file_input('image',['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('enabled') !!}
                {!! checkbox('enabled', true) !!}
            </div>
        </div>

    </div>

    <div class="form-group form-actions">
        {!!submit('Save Manufacturer', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
