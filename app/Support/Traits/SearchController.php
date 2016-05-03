<?php
    namespace App\Support\Traits;

    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Str;

    trait SearchController
    {

        public function search()
        {

            if (isset( $this->searchModel )) {

                $model = $searchModel = new $this->searchModel();

                if (isset( $this->searchRelations )) {
                    $model = $model->with( $this->searchRelations );
                }

                $modelName = strtolower( Str::plural( class_basename( $model->getModel() ) ) );

                if (method_exists( $this, 'search' )) {
                    $model = $model->search( Input::get( 'query' ) );
                }

                $searchModel = $model;

                if (isset( $this->noPaginate ) && ( $this->noPaginate == true )) {
                    $model = $model->get();
                } else {
                    $model = $model->paginate();
                }
                if ( ! $model->count()) {
                    $model = $searchModel;
                }

                $viewPrefix = ( isset( $this->viewPrefix ) ) ? $this->viewPrefix . '.' : '';

                $this->content( $viewPrefix . $modelName . '.index', [ $modelName => $model ] );
            }
        }
    }