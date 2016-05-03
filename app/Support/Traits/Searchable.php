<?php
    namespace App\Support\Traits;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Str;

    trait Searchable
    {

        /**
         * @var
         */
        private $modelName;

        /**
         * @var array
         */
        private $columns = [ ];

        /**
         * @var array
         */
        protected $defaultExcludes = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'remember_token',
            'password'
        ];

        /**
         * @param \Illuminate\Database\Eloquent\Builder $query
         * @param string                                $keyword
         *
         * @return mixed
         */
        public function scopeSearch( Builder $query, $keyword = '' )
        {
            if ($keyword) {
                
                $this->modelName = strtolower( Str::plural( class_basename( $query->getModel() ) ) );

                $searchable = $this->processFilterExcludes( $query );

                $query = $this->searchSingle( $searchable, $query, $keyword );

//        $query = $this->searchMultiple( $searchable, $query, $keyword );


                return $query;
            }

            return null;
        }

        /**
         * @param $query
         *
         * @return mixed
         */
        private function processFilterExcludes( $query )
        {

            foreach ($this->getSearchRelated( $query ) as $name => $column) {
                $modelType                              = ! is_object( $name ) ? 'main' : 'related';
                $this->columns[ $modelType ][ $column ] = Schema::getColumnListing( $column );
            }

            foreach ($this->columns as $model => $parent) {
                foreach ($parent as $parentName => $children) {
                    $this->columns[ $model ][ $parentName ] = array_diff( $children,
                        $this->getExcludes() );
                }
            }

            return $this->columns;
        }

        /**
         * @param $searchable
         * @param $query
         * @param $keyword
         *
         * @return null
         */
        protected function searchSingle( $searchable, $query, $keyword )
        {

            foreach ($searchable as $type => $tables) {
                foreach ($tables as $table => $column) {
                    if ($type == 'main') {
                        $query->where( $table . '.' . head( $column ), 'LIKE', "%{$keyword}%" );
                        foreach ($column as $item) {
                            $query->orWhere( $table . '.' . $item, 'LIKE', "%{$keyword}%" );
                        }
                    } else {
                        $query->whereHas( $table,
                            function ( $q ) use ( $keyword, $table, $column ) {
                                $q->whereNested( function ( $q ) use ( $column, $table, $keyword ) {
                                    foreach ($column as $item) {
                                        $q->orWhere( $table . '.' . $item, 'LIKE', "%{$keyword}%" );
                                    }
                                } );
                            } );
                    }
                }
            }

            return $query;
        }

        /**
         * @return array
         */
        public function getSearchRelated()
        {
            return (array) $this->searchRelated ?: [ $this->modelName ];
        }

        /**
         * @return array
         */
        public function getSearchExcludes()
        {
            return (array) $this->searchExcludes ?: [ ];
        }

        /**
         * @return array
         */
        protected function getExcludes()
        {
            return array_merge( $this->getSearchExcludes(), $this->defaultExcludes );
        }
    }