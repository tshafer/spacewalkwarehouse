<?php
    namespace App\Support\Traits;

    use Illuminate\Support\Str;

    trait Sluggable
    {

        /**
         * Boot the model
         */
        protected static function boot()
        {
            parent::boot();

            static::saving( function ( $model ) {
                $model->slug = Str::slug( $model->getTitleField() );
            } );
        }

        /**
         * @return string
         */
        public function getTitleField()
        {
            return $this->titleField ? $this->{$this->titleField} : $this->title;
        }
    }