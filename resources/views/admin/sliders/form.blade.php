<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Slider</h2>
        </div>

        <div class="form-bordered">


            <div class="form-group">
                {!! Form::label('title') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('url') !!}
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                @if(isset($slider) && $slider->getMedia('sliders')->first())
                    <img src="{{url('/')}}{!! $slider->getMedia('sliders')->first()->getUrl('adminThumb')!!}"/><br/>
                @endif
                {!! Form::label('image') !!}
                {!! Form::file('image',['class' => 'form-control']) !!}
            </div>

        </div>

    </div>

    <div class="form-group form-actions">
        {!!Form::submit('Save Slider', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
