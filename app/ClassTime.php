<?php
namespace Wash;

use Illuminate\Database\Eloquent\Model;
use Wash\Support\Traits\Attributes;

class ClassTime extends Model
{

    use Attributes;

    /**
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_date', 'end_date'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function fitClass()
    {
        return $this->hasMany('Wash\FitClass');
    }
}
