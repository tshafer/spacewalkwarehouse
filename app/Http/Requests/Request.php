<?php
    namespace Wash\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    abstract class Request extends FormRequest
    {

        /**
         * @var array
         */
        protected $dontFlash = [ 'photo' ];

    }
