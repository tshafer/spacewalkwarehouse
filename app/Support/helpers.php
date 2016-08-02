<?php

if ( ! function_exists('toolbar_link')) {
    /**
     * @param $route
     * @param $icon
     * @param $tooltip
     *
     * @return string
     */
    function toolbar_link($route, $icon, $tooltip)
    {
        if (is_array($route)) {
            $href = route($route[0], [$route[1]]);
        } else {
            $href = route($route);
        }

        return '<a href="' . $href . '" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="' . $tooltip . '"><i class="fa ' . $icon . '"></i></a>';
    }

}

if ( ! function_exists('defaultProductImage')) {
    /**
     * @param $product
     *
     * @return string
     */
    function defaultProductImage($product, $size = 'thumb')
    {
        if ($product->getMedia('products')->count() > 0) {
            $defaultItem = $product->getMedia('products')->reject(function ($item) {
                return array_get($item->custom_properties, 'default') == false;
            });
            if ($defaultItem->count() > 0) {
                return '<img src="' . url('/') . $defaultItem->first()->getUrl($size) . '" alt="' . $product->name . '"/>';
            } elseif($product->getMedia('products')->count() > 0) {
                return '<img src="' . url('/') . $product->getMedia('products')->first()->getUrl($size) . '" alt="' . $product->name . '"/>';
            }
        }
    }
}


