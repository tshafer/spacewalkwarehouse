<?php namespace Wash;

use Illuminate\Database\Eloquent\Model;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;

class FitFest extends Model
{

    use Linkable, Sortable, Attributes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fitfest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];


    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->belongsToMany( 'Wash\FitClass' );
    }
}
