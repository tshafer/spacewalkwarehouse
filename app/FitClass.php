<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use App\Support\WashCollection;

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
        return $this->belongsTo( 'App\ClassTime' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->belongsToMany( 'App\FitFest' );
    }

    /**
     * @param array $models
     *
     * @return \App\Support\WashCollection
     */
    public function newCollection( array $models = [ ] )
    {
        return new WashCollection( $models );
    }
}
