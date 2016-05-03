<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;


class Ticket extends Model
{

    use Linkable, Sortable, Attributes, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';

    /**
     * @var array
     */
    protected $dates = ['redeemed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'ticket_id',
      'attendee_id',
      'redeemed_at',
      'vip',
      'qr_status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    /**
     * @return string
     */
    public function getVipStatusAttribute()
    {
        return ($this->vip == 1) ? 'YES' : 'No';
    }

    /**
     * @return string
     */
    public function getRedeemedAtAttribute()
    {
        return $this->attributes['redeemed_at'];
    }

    /**
     * @return string
     */
    public function getQrStatusFormatAttribute()
    {
        return ($this->qr_status == 1) ? 'YES' : 'NO';
    }

}
