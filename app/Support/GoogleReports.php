<?php

namespace Wash\Support;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GoogleReports
{


    /**
     *
     */
    public function __construct()
    {

    }



    /**
     * Get YTD pageviews by author
     *
     * @return array Keys are author names and values are number of pageviews this
     * year for all articles published any time with that author in the author list.
     * A one month allowance is made after a new year starts to allow viewing the
     * data for previous year through January of the following year.
     */
    function getYTDPageviews()
    {

        Cache::get('getYTDPageviewssorted');



    }






}