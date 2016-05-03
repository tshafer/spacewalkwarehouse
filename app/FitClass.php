<?php namespace Wash;

use Illuminate\Database\Eloquent\Model;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;
use Wash\Support\WashCollection;

/**
 * @package Wash
 */
class FitClass extends Model
{

    use Attributes, Linkable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classTime()
    {
        return $this->belongsTo( 'Wash\ClassTime' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->belongsToMany( 'Wash\FitFest' );
    }

    /**
     * @param array $models
     *
     * @return \Wash\Support\WashCollection
     */
    public function newCollection( array $models = [ ] )
    {
        return new WashCollection( $models );
    }
}
