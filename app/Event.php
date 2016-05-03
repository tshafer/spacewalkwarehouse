<?php

namespace Wash;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Event extends Model implements HasMedia
{

    use Linkable, Sortable, Attributes, SoftDeletes, HasMediaTrait;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'city',
        'state',
        'address',
        'country',
        'zip_code',
        'event_end',
        'event_start',
        'description',
        'response',
        'max_tickets',
        'extra_fields'
    ];

    /**
     * @var array
     */
    protected $dates = [ 'event_start', 'event_end' ];


    /**
     *
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')->setManipulations([
                'w' => 368,
                'h' => 232
            ])->performOnCollections('images');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function ticketTypes()
    {
        return $this->belongsToMany(TicketType::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $address = '';

        if ($this->attributes['address']) {
            $address .= $this->attributes['address'] . '<br/>';
        }
        if ($this->attributes['city']) {
            $address .= $this->attributes['city'] . ', ';
        }
        if ($this->attributes['state']) {
            $address .= $this->attributes['state'] . ' ';
        }
        if ($this->attributes['zip_code']) {
            $address .= $this->attributes['zip_code'];
        }

        return $address;
    }


    /**
     * Format Event Start Attribute
     *
     * @param $value
     *
     * @return mixed
     */
    public function getEventStartAttribute($value)
    {
        if ($value != '0000-00-00 00:00:00') {
            return Carbon::parse($value)->format($this->defaultDateFormat);
        }
    }


    /**
     * Format Event Event Attribute
     *
     * @param $value
     *
     * @return mixed
     */
    public function getEventEndAttribute($value)
    {
        if ($value != '0000-00-00 00:00:00') {
            return Carbon::parse($value)->format($this->defaultDateFormat);
        }
    }

    /**
     * @return string
     */
    public function getEventStartDateAttribute()
    {
        $value = $this->attributes['event_start'];

        return Carbon::parse($value)->format('m/d/Y');
    }


    /**
     * @return string
     */
    public function getEventStartTimeAttribute()
    {
        $value = $this->attributes['event_start'];

        return Carbon::parse($value)->format('h:ia');
    }


    /**
     * @param $value
     */
    public function setEventStartAttribute($value)
    {
        if ($value) {
            $this->attributes['event_start'] = Carbon::createFromFormat('m/d/Y g:i A', $value)->toDateTimeString();
        }
    }


    /**
     * @param $value
     */
    public function setEventEndAttribute($value)
    {
        if ($value) {
            $this->attributes['event_end'] = Carbon::createFromFormat('m/d/Y g:i A', $value)->toDateTimeString();
        }
    }
}
