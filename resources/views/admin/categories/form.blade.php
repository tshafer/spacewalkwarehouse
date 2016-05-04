<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Category</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('parent_category') !!}
                {!! select('parent_category', [''] + $nestedList, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('intro_text') !!}
                {!! textarea('intro_text', null, ['class' => 'form-control']) !!}
            </div>

        </div>

    </div>

    <div class="form-group form-actions">
        {!!submit('Save Category', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
