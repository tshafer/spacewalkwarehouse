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


