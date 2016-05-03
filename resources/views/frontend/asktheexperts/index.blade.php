@extends('layout')

@section('title') Profile @endsection

@section('content')
    <article id="content-container">
        <div class="row">
            <div class="col-md-8">
                <h3>Profile copy submission form</h3>
                <p style="font-size:15px">After reserving your advertising space with your Washingtonian sales rep please use the following form to verify your information and submit your copy.  <br/>To arrange for a Washingtonian photographer to take your picture, contact your sale representative.</p><br/><br/>

                {!! open(['route' => 'asktheexperts.store', 'method' => 'POST', 'files' => true]) !!}

                <div class="form-group">
                    {!!label('Profile Size')!!}
                    {!!select('placement',Config::get('wash.placements'), Input::old('placement'),['class' => 'form-control', 'id' => 'placement'])!!}
                </div>
                <div id="form-body">

                </div>

                <div class="form-group">
                    {!! submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!!close()!!}
            </div>
        </div>
    </article>
@endsection

@section('scripts')
    <script>
        (function($){
            $.fn.textareaCounter = function(options) {

                return this.each(function() {
                    var obj, text, wordcount, limited, limit, div;

                    obj = $(this);
                    limit = obj.attr('data-limit');

                    if(limit) {

                        if(obj.next('.help-block').length < 1)
                        {
                            obj.after('<p class="help-block" id="counter-text">' + limit + ' words Max.</p>');
                        }

                        obj.keyup(function () {
                            text = obj.val();
                            if (text === "") {
                                wordcount = 0;
                            } else {
                                wordcount = $.trim(text).split(" ").length;
                            }
                            div = obj.next('.help-block');
                            if (wordcount > limit) {
                                div.html('<span style="color: #DD0000;">0 words left.</span>');
                                limited = $.trim(text).split(" ", limit);
                                limited = limited.join(" ");
                                $(this).val(limited);
                            } else {
                                div.html((limit - wordcount) + ' words left.');
                            }
                        });
                    }
                });
            };
        })(jQuery);

        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "GET",
                url: "/api/asktheexperts/full"
            })
                    .done(function( html ) {
                        load(html);
                    });

            $("#placement").change(function(){
                var id = $( this ).val();
                $.ajax({
                    method: "GET",
                    url: "/api/asktheexperts/" + id
                })
                        .done(function( html ) {
                            load(html);
                        });
            });
        })
        function load(html) {
            $( "#form-body").empty().append( html );
            $("input[name=website]").inputmask("url");
            $("input[name=need_email]").inputmask("email");
            $("input[name=zip]").inputmask({ "mask": "99999" });
            $('input[name=phone], input[name=need_phone]').inputmask("mask", {"mask": "(999) 999-9999"});
            $("textarea[name=specialization],textarea[name=designations], textarea[name=body] ").textareaCounter();
        }
        $.validate({
            modules : 'file'
        });
    </script>
@endsection