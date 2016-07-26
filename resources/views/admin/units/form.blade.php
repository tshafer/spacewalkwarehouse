<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Unit</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('product') !!}
                {!! select('product', $products, $productId, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('description') !!}
                {!! textarea('description', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! label('height') !!}
                {!! text('height', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('width') !!}
                {!! text('width', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('price') !!}
                {!! text('price', null, ['class' => 'form-control']) !!}
            </div>

        </div>

    </div>

    <div class="form-group form-actions">
        {!!submit('Save Unit', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>

