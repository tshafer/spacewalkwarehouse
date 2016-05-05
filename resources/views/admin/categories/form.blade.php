<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Category</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('parent_category') !!}
                {!! select('parent_category', ['None'] + $nestedList, $parentId, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('title') !!}
                {!! text('title', null, ['class' => 'form-control']) !!}
            </div>

            @if(isset($category) && !$category->isRoot())
                @if(count($manufacturers)> 0)
                    <div class="form-group">
                        {!! label('manufacturers') !!}
                        {!! select('manufacturers[]', $manufacturers, $category->manufacturers->pluck('id')->toArray(), ['class' => 'form-control', 'style' => 'height:200px','multiple']) !!}
                    </div>
                @endif

            @elseif(!isset($category))
                @if(count($manufacturers)> 0)
                    <div class="form-group">
                        {!! label('manufacturers') !!}
                        {!! select('manufacturers[]', $manufacturers, null, ['class' => 'form-control', 'style' => 'height:200px','multiple']) !!}
                    </div>
                @endif
            @endif


            <div class="form-group">
                {!! label('intro_text') !!}
                {!! textarea('intro_text', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                @if(isset($category) &&  $category->getMedia('categories')->first())
                    <img src="{{url('/')}}{!! $category->getMedia('categories')->first()->getUrl('adminThumb')!!}"/><br/>
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
        {!!submit('Save Category', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
