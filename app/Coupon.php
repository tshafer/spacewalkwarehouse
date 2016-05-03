<?php

namespace Wash;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;


class Coupon extends Model
{

    use Linkable, Sortable, Attributes, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var array
     */
    protected $dates = ['redeem_by'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'code',
      'duration',
      'amount_off',
      'duration_in_months',
      'max_redemptions',
      'percent_off',
      'redeem_by',
      'event_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @param $value
     */
    public function setRedeemByAttribute($value)
    {

        $this->attributes['redeem_by'] = Carbon::createFromFormat('m/d/Y g:i A', $value)->toDateTimeString();
    }
}
