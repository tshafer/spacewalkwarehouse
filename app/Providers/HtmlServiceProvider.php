<?php
    namespace Wash\Providers;

    use Collective\Html\FormFacade as Form;
    use Collective\Html\HtmlFacade as Html;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Str;

    /**
     * Class HtmlServiceProvider
     *
     * @package Wash\Providers
     */
    class HtmlServiceProvider extends ServiceProvider
    {

        /**
         * Register the application services.
         *
         * @return void
         */
        public function boot()
        {
            $this->bindHelpHelper();
            $this->bindToolbarHelper();
            $this->bindPhoneHelper();
            $this->bindSearchHelper();
        }


        /**
         *
         */
        private function bindHelpHelper()
        {

            $html = $this->app[ 'html' ];

            $html->macro( 'help',
                function ( $title, $text, $trigger = 'hover', $placement = 'right' ) {
                    return <<<HELP
  <span data-toggle="popover" title="{$title}" data-content="{$text}" data-container="body" data-trigger="{$trigger}" data-placement="{$placement}" style="cursor: pointer;">[?]</span>
HELP;
                } );
        }

        /**
         *
         */
        private function bindToolbarHelper()
        {
            $html = $this->app[ 'html' ];

            $html->macro( 'sort', function ( $text, $column, $dir = 'asc' ) {

                $param[ 'dir' ] = $dir;

                if (Input::get( 'dir' ) == 'asc') {
                    $param[ 'dir' ] = 'desc';
                }

                if (Input::has( 'query' )) {
                    $param[ 'query' ] = Input::get( 'query' );
                }
                if (Input::has( 'page' )) {
                    $param[ 'page' ] = Input::get( 'page' );
                }

                $param[ 'sort_by' ] = $column;

                $html = '<a href="?' . http_build_query( $param ) . '">' . $text . '</a>';

                if (Input::get( 'sort_by' ) == $column) {
                    $icon = Input::get( 'dir' ) == 'asc' ? 'fa-chevron-up' : 'fa-chevron-down';
                    $html .= ' <i class="fa ' . $icon . '"></i>';
                }

                return $html;
            } );
        }


        /**
         *
         */
        private function bindPhoneHelper()
        {
            $html = $this->app[ 'html' ];

            $html->macro( 'phone', function ( $phone, $attributes = [ ], $secure = null ) {
                $number = Str::slug( $phone, '' );
                switch (strlen( $number )) {
                    case 10:
                        $phone  = '(' . substr( $number, 0, 3 ) . ') ' . substr( $number, 3,
                                3 ) . '-' . substr( $number, 6, 4 );
                        $number = '+1' . $number;
                        break;
                }
                // Convert vanity numbers
                $number = str_ireplace( [ 'A', 'B', 'C' ], 2, $number );
                $number = str_ireplace( [ 'D', 'E', 'F' ], 3, $number );
                $number = str_ireplace( [ 'G', 'H', 'I' ], 4, $number );
                $number = str_ireplace( [ 'J', 'K', 'L' ], 5, $number );
                $number = str_ireplace( [ 'M', 'N', 'O' ], 6, $number );
                $number = str_ireplace( [ 'P', 'Q', 'R', 'S' ], 7, $number );
                $number = str_ireplace( [ 'T', 'U', 'V' ], 8, $number );
                $number = str_ireplace( [ 'W', 'X', 'Y', 'Z' ], 9, $number );

                return Html::link( "tel:{$number}", strtoupper( $phone ), $attributes, $secure );
            } );
        }

        /**
         *
         */
        private function bindSearchHelper()
        {
            $html = $this->app[ 'html' ];

            $html->macro( 'search',
                function ( $model, $modelName = null, $prefix = 'admin', $block = '' ) {

                    if ($model instanceof LengthAwarePaginator) {
                        $model = $model->first();
                    }

                    if ($model instanceof Collection) {
                        $model = $model->first();
                    }

                    if ($model) {
                        $name = class_basename( $model->getModel() );
                    } else {
                        $name = $modelName;
                    }
                    if ($name) {
                        $prefix = isset( $prefix ) ? $prefix . '.' : null;

                        $route = $prefix . Str::lower( Str::plural( $name ) ) . '.search';

                        $param[ 'dir' ] = ( Input::get( 'dir' ) == 'asc' ) ? 'asc' : 'desc';

                        if (Input::has( 'sort_by' )) {
                            $param[ 'sort_by' ] = Input::get( 'sort_by' );
                        }

                        if (Input::has( 'cat' )) {
                            $param[ 'cat' ] = Input::get( 'cat' );
                        }

                        $html = Form::open( [
                            'route'  => [ $route ],
                            'method' => 'get',
                            'style'  => 'display:inline-block'
                        ] );

                        $html .= Form::text( 'query', Input::get( 'query' ), [
                            'class'       => 'form-control',
                            'placeholder' => 'Search',
                            'style'       => 'display: inline-block;width: 59%;margin-right: 4px;margin-top: 3px;'
                        ] );

                        if (is_array( $param )) {
                            foreach ($param as $key => $content) {
                                $html .= Form::hidden( $key, $content );
                            }
                        }
                        $html .= Form::submit( 'Search',
                            [ 'class' => 'btn btn-sm btn-primary' . ( $block ? 'btn-block' : '' ) ] );

                        $html .= Form::button( 'Clear', [
                            'class'   => 'btn btn-sm btn-primary' . ( $block ? 'btn-block' : '' ),
                            'onClick' => "window.location = window.location.href.split('?')[0]"
                        ] );
                        $html .= Form::close();

                        return $html;
                    }
                } );
        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
        }
    }
