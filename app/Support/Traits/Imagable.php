<?php
    namespace App\Support\Traits;

    use Illuminate\Support\Facades\File;

    trait Imagable
    {

        /**
         * Set Image Attribute
         *
         * @param string $value
         */

        /**
         * @param $value
         */
        protected function uploadImage( $field, $value )
        {

            if (isset( $this->attributes[ $field ] ) && $this->attributes[ $field ] != '') {
                $filename = public_path() . '/uploads/' . $this->attributes[ $field ];

                if (File::exists( $filename )) {
                    File::delete( $filename );
                }
            }

            if ($value == '') {
                $this->attributes[ $field ] = '';
            } else {
                $filename = time() . str_random( 10 ) . '.' . $value->getClientOriginalExtension();

                $value->move( public_path() . '/uploads/', $filename );

                $this->attributes[ $field ] = $filename;
            }
        }
    }