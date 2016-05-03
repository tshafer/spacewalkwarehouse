<?php

namespace Wash\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GoogleReports extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate google report.';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $client_id;

    /**
     * @var string
     */
    protected $client_secret;

    /**
     * @var string
     */
    protected $refresh_token;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->refresh_token = '1/_DjSDuNdDs58oZ6av7nOUGGnpP0lvWY-Cz9WHKfqyo4';

        $this->client_id = '438220578501.apps.googleusercontent.com';

        $this->client_secret = 'VKdKW8cdNQu63LTFNY6tN2tc';

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time_start = microtime(true);

        $this->getYTDPageviews();

        $this->info('Total execution time in seconds: ' . (microtime(true) - $time_start));
    }

    /**
     * Return Google Core Reporting API access token
     *
     * @return string|bool access token or false if embedded parameters invalid
     */
    protected function getAccessToken()
    {
        $response = $this->client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
          'form_params' => [
            'refresh_token' => $this->refresh_token,
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type'    => 'refresh_token',
          ],
          'debug' => true
        ]);

        $body = $response->getBody();

        $json = json_decode($body->getContents(), true);

        return isset($json['access_token']) ? $json['access_token'] : false;
    }

    /**
     * Query API and retrieve array of rows from JSON response(s)
     *
     * @param $access_token
     * @param $options
     *
     * @return Collection
     */
    function getNewData($access_token, $options)
    {

        $this->info('Getting New Data');

        $allData = new Collection();

        $options['ids'] = 'ga:3360489';

        $options = array_filter($options);

        $options['start-index'] = 1;

        do {

            $response = $this->client->request('GET', 'https://www.googleapis.com/analytics/v3/data/ga', [
              'headers' => ['Authorization' => 'Bearer ' . $access_token],
              'query'   => $options,
              'debug' => true
            ]);

            $options['start-index'] += 1000;

            $decoded = json_decode($response->getBody(), true);
            $this->info('Returning Data');
            $this->info('Walking the array');
            array_walk($decoded['rows'], function ($items, $foo) use ($allData) {
                $this->info('Processsing...' . $items[1] . '   -   ' . $items[4] . '   -   ' . $items[3] .'   -   '.$items[2]);
                $allData->push($items);
            });
        } while (isset($decoded['nextLink']));

        $this->info('Returning Data');

        return $allData;
    }

    /**
     * Check for recent cached data and return that or newly fetched data. This function
     * can fail if the cache needs to be refreshed but getAccessToken returns false.
     *
     * @param  array $options Query parameters
     *
     * @return object                  JSON decoded API response
     */
    function getData($options)
    {
        $this->info('Getting Data');

        $access_token = $this->getAccessToken();

        return $this->getNewData($access_token, $options);
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
        $this->info('Grabbing Page Views');

        return Cache::remember('getYTDPageviews', 720, function () {

            $this->info('Caching Page Views');

            $options = [
              'start-date'  => Carbon::now()->startOfYear()->format('Y-m-d'),
              'end-date'    => Carbon::now()->endOfYear()->format('Y-m-d'),
              //'dimensions'  => 'ga:customVarName1, ga:customVarValue1, ga:pagePath, ga:pageTitle, ga:month',
              'dimensions'  => 'ga:customVarName1, ga:customVarValue1, ga:pagePath, ga:month',
              'metrics'     => 'ga:pageviews',
              'filters'     => 'ga:customVarName1==Author',
              'max-results' => null,
            ];

            $getYTDPageviews = $this->getData($options);

            $data = $this->combineByAuthor($getYTDPageviews, []);

            $collection = $this->combineByMonth($data, []);

            return collect($collection);
        });

        $this->info('Page Views Returned');
    }

    /**
     * @param $rows
     * @param $data
     *
     * @return array
     */
    protected function combineByAuthor($rows, $data)
    {
        foreach ($rows as $item) {
            $authors = explode(',', $item[1]);

            foreach ($authors as $author) {
                if (isset($data[$author])) {
                    $data[$author][] = $item;
                } else {
                    $data[$author][] = $item;
                }
            }
        }

        return $data;
    }

    /**
     * @param $data
     * @param $collection
     *
     * @return mixed
     */
    protected function combineByMonth($data, $collection)
    {
        foreach ($data as $author => $items) {

            foreach ($items as $item) {
                if (isset($collection[$author][$item[3]])) {
                    $collection[$author][$item[3]][] = $item;
                } else {
                    $collection[$author][$item[3]][] = $item;
                }
            }
            ksort($collection[$author]);
        }

        return $collection;
    }

    /**
     * Get 30 day pageviews by author
     * @return array Keys are author names and values are number of pageviews in
     * last 30 days for all articles published during the same period with that
     * author in the author list.
     */
    //function get30DPageviews()
    //{
    //
    //    $data = []; // hold return values
    //    $options = [
    //      'start-date'  => date('Y-m-d', strtotime('-30 day')),
    //      'end-date'    => date('Y-m-d', strtotime('-1 days')),
    //      'dimensions'  => 'ga:customVarName1,ga:customVarValue1,ga:customVarName4,ga:customVarValue4',
    //      'metrics'     => 'ga:pageviews',
    //      'filters'     => 'ga:customVarName1==Author,ga:customVarName4==Day',
    //      'segment'     => '',
    //      'sort'        => '',
    //      'max-results' => '',
    //    ];
    //    $rows = $this->getData('30d_pageviews', time() - strtotime("today"), $options);
    //    foreach ($rows as $row) {
    //        $row_ts = strtotime($row[3]); // timestamp of date from current row
    //        $min_ts = strtotime($options['start-date']);
    //        $max_ts = strtotime($options['end-date']);
    //        if ($row_ts <= $max_ts && $row_ts >= $min_ts) {
    //            $authors = explode(',', $row[1]);
    //            foreach ($authors as $author) {
    //                if (isset($data[$author])) {
    //                    $data[$author] = $data[$author] + $row[4];
    //                } else {
    //                    $data[$author] = $row[4];
    //                }
    //            }
    //        }
    //    }
    //
    //    return $data;
    //}
}
