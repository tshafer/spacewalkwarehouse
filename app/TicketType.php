<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Carbon\Carbon;

class TicketType extends Model
{

    use Linkable, Sortable, Attributes, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ticket_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_price',
        'ticket_name',
        'max_tickets',
        'start_time',
        'end_time',
    ];

    /**
     * @var array
     */
    protected $dates = [ 'start_time', 'end_time' ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function event()
    {
        return $this->belongsToMany(Event::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'ticket_type_id', 'id');
    }


    /**
     * @param $value
     */
    public function setStartTimeAttribute($value)
    {
        if ($value) {
            $this->attributes['start_time'] = Carbon::createFromFormat('m/d/Y g:i A', $value)->toDateTimeString();
        }
    }


    /**
     * @param $value
     */
    public function setEndTimeAttribute($value)
    {
        if ($value) {
            $this->attributes['end_time'] = Carbon::createFromFormat('m/d/Y g:i A', $value)->toDateTimeString();
        }
    }


    /**
     * @param $value
     *
     * @return string
     */
    public function getStartTimeAttribute($value)
    {
        if ($value != '0000-00-00 00:00:00') {
            return Carbon::parse($value)->format($this->defaultDateFormat);
        }
    }


    /**
     * @param $value
     *
     * @return string
     */
    public function getEndTimeAttribute($value)
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
        $value = $this->attributes['start_time'];

        return Carbon::parse($value)->format('m/d/Y');
    }


    /**
     * @return string
     */
    public function getEventStartTimeAttribute()
    {
        $value = $this->attributes['start_time'];

        return Carbon::parse($value)->format('h:ia');
    }

}
