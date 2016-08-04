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
    function defaultProductImage($product, $size = 'category_page')
    {
        if ($product->getMedia('products')->count() > 0) {
            $defaultItem = $product->getMedia('products')->reject(function ($item) {
                return array_get($item->custom_properties, 'default') == false;
            });

            if ($defaultItem->count() > 0) {
                return '<div class="product-image"><img src="' . url('/') . $defaultItem->first()->getUrl($size) . '" class="img-responsive product-img" alt="' . $product->name . '"/>' . wetDry($product) . '</div>';
            } elseif ($product->getMedia('products')->count() > 0) {
                return '<div class="product-image"><img src="' . url('/') . $product->getMedia('products')->first()->getUrl($size) . '" class="img-responsive product-img" alt="' . $product->name . '"/>' . wetDry($product) . '</div>';
            }
        }
    }

    /**
     * @param $product
     *
     * @return string
     */
    function wetDry($product)
    {
        if ($product->season) {
            return '<img class="badge-overlay" src="' . url('/') . '/images/' . $product->season . '_badge.png" alt="' . $product->name . '"/>';
        }

        return '';
    }
}


