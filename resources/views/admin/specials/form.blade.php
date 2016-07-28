<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Special</h2>
        </div>

        <div class="form-bordered">


            <div class="form-group">
                {!! label('title') !!}
                {!! text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('description') !!}
                {!! textarea('description', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                @if(isset($category) &&  $category->getMedia('categories')->first())
                    <img src="{{url('/')}}{!! $category->getMedia('categories')->first()->getUrl('adminThumb')!!}"/><br/>
                @endif
                {!! label('image') !!}
                {!! file_input('image',['class' => 'form-control']) !!}
            </div>

        </div>

    </div>

    <div class="form-group form-actions">
        {!!submit('Save Special', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
