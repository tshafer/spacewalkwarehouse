<?php
    namespace Wash\Services;

    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Cache;

    class GeoService
    {

        /**
         * API Endpoint
         *
         * @var string
         */

        protected $apiEndpoint = 'https://maps.google.com/maps/api/geocode/json?address={address}';


        /**
         * Generate Lat Long
         *
         * @param $address
         * @param $city
         * @param $state
         * @param $zip
         *
         * @return Collection;
         */
        public function latLong( $address, $city, $state, $zip )
        {
            $encodedAddress = urlencode( $address . ',' . $city . ',' . $state . ',' . $zip );

            $apiUrl = $this->makeEndpoint( $encodedAddress );

            $response = $this->fetch( $apiUrl );

            return Collection::make( $response );
        }

        /**
         * Make Endpoint URL
         *
         * @param $encodedAddress
         *
         * @return mixed
         */
        public function makeEndpoint( $encodedAddress )
        {
            return str_replace( [ '{address}' ], [ $encodedAddress ], $this->apiEndpoint );
        }

        /**
         * Fetch an API Response
         *
         * @param  string $url
         *
         * @return Object
         */
        public function fetch( $url )
        {
            return Cache::rememberForever( $url, function () use ( $url ) {
                try {
                    $data = json_decode( file_get_contents( $url ) );

                    if ($data->status == 'OK') {
                        return $data->results[ 0 ]->geometry->location;
                    }
                } catch( \Exception $e ) {
                    return null;
                }
            } );
        }
    }