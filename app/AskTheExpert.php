<?php
namespace Wash;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Imagable;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;

/**
 * Class AskTheExpert
 *
 * @package Wash
 */
class AskTheExpert extends Model
{

    use Linkable, Sortable, Attributes, Imagable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asktheexperts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'phone',
      'address',
      'city',
      'state',
      'zip',
      'body',
      'photo',
      'placement',
      'website',
      'specialization',
      'designations',
      'peoples_names',
      'need_name',
      'need_email',
      'need_phone',
      'headline',
      'sub_headline',
      'address_2',
      'address2_1',
      'address2_2',
      'address2_city',
      'address2_state',
      'address2_zip',
      'address3_1',
      'address3_2',
      'address3_city',
      'address3_state',
      'address3_zip',
    ];


    /**
     * @param $value
     */
    public function setPhotoAttribute($value)
    {
        $this->uploadImage('photo', $value);
    }

    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address . ' ' . $this->address_2 . '<br/>' . $this->city . ' ' . $this->zip . ', ' . $this->state;
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
    public function getFullAddress2Attribute()
    {
        return $this->address2_1 . ' ' . $this->address2_1 . '<br/>' . $this->address2_city . ' ' . $this->address2_zip . ', ' . $this->address2_state;
    }

    /**
     * @return string
     */
    public function getFullAddress3Attribute()
    {
        return $this->address2_1 . ' ' . $this->address2_1 . '<br/>' . $this->address2_city . ' ' . $this->address2_zip . ', ' . $this->address2_state;
    }


    /**
     * @param $value
     */
    public function getPlacementAttribute($value)
    {
        $placement = config('wash.placements');

        return $placement[$value];
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m-d-Y');
    }

    /**
     * @param $value
     *
     * @return mixed|string
     */
    function getPhoneAttribute($value)
    {
        return $this->formatPhone($value);
    }

    /**
     * @param $value
     *
     * @return mixed|string
     */
    function getNeedPhoneAttribute($value)
    {
        return $this->formatPhone($value);
    }
}
