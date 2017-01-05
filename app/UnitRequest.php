<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitRequest extends Model
{

    use Linkable, Sortable, Attributes, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'unit_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'branch_name',
        'message',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }

}
