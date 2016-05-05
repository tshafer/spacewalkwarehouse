<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Product</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('category') !!}
                {!! select('categories[]', $nestedList, $parentId, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            @if(count($manufacturers)> 0)
                <div class="form-group">
                    {!! label('manufacturers') !!}
                    {!! select('manufacturers[]', $manufacturers, isset($product) ? $product->manufacturers->pluck('id')->toArray() : null, ['class' => 'form-control', 'style' => 'height:200px','multiple']) !!}
                </div>
            @endif


            <div class="form-group">
                {!! label('description') !!}
                {!! textarea('description', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                @if(isset($product) &&  $product->getMedia('products')->first())
                    <img src="{!! $product->getMedia('products')->first()->getUrl('adminThumb')!!}"/><br/>
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
        {!!submit('Save Product', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
