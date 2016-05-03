<?php
    namespace Wash\Support;

    use Illuminate\Database\Eloquent\Collection;

    /**
     * Class WashCollection
     *
     * @package Wash\Support
     */
    class WashCollection extends Collection
    {

        /**
         * @param        $attribute
         * @param string $order
         *
         * @return $this
         */
        public function orderBy( $attribute, $order = 'asc' )
        {
            $this->sortBy( function ( $model ) use ( $attribute ) {
                return $model->{$attribute};
            } );

            if ($order == 'desc') {
                $this->items = array_reverse( $this->items );
            }

            return $this;
        }
    }