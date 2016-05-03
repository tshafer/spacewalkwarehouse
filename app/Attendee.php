<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Cartalyst\Stripe\Billing\Laravel\Billable;
use Cartalyst\Stripe\Billing\Laravel\BillableContract;


class Attendee extends Model implements BillableContract
{

    use Linkable, Sortable, Attributes, SoftDeletes, Billable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendees';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'coupon_code',
      'address',
      'city',
      'state',
      'zipcode',
      'extra_fields_answers',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function ticketUrl()
    {
        if($this->ticket_path)
            return url() . '/uploads/events/' . $this->ticket_path;
    }


}
