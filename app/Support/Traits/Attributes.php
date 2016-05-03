<?php
namespace App\Support\Traits;

use Carbon\Carbon;

trait Attributes
{

    protected $defaultDateFormat = 'm/d/Y - h:ia';

    /**
     * Format Created At Attribute
     *
     * @param $value
     *
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format($this->defaultDateFormat);
    }

    /**
     * Format Updated At Attribute
     *
     * @param $value
     *
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format($this->defaultDateFormat);
    }

    /**
     * Format Deleted At Attribute
     *
     * @param $value
     *
     * @return mixed
     */
    public function getDeletedAtAttribute($value)
    {
        return Carbon::parse($value)->format($this->defaultDateFormat);
    }

    /**
     * @return null|string
     */
    public function getHumanCreatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("created_at");
    }

    /**
     * @param $column
     *
     * @return null|string
     */
    protected function getHumanTimestampAttribute($column)
    {
        if ($this->attributes[$column]) {

            return Carbon::parse($this->attributes[$column])->diffForHumans();
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getHumanUpdatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("updated_at");
    }

    /**
     * @return null|string
     */
    public function getHumanDeletedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("deleted_at");
    }

    /**
     * @param $value
     *
     * @return mixed|string
     */
    public function getPhoneAttribute($value)
    {
        return $this->formatPhone($value);
    }

    /**
     * @param $value
     *
     * @return mixed|string
     */
    public function getFaxAttribute($value)
    {
        return $this->formatPhone($value);
    }


    /**
     * @param $value
     *
     * @return mixed|string
     */
    private function formatPhone($value)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $value);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else {
            if (strlen($phoneNumber) == 10) {
                $areaCode = substr($phoneNumber, 0, 3);
                $nextThree = substr($phoneNumber, 3, 3);
                $lastFour = substr($phoneNumber, 6, 4);

                $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
            } else {
                if (strlen($phoneNumber) == 7) {
                    $nextThree = substr($phoneNumber, 0, 3);
                    $lastFour = substr($phoneNumber, 3, 4);

                    $phoneNumber = $nextThree . '-' . $lastFour;
                }
            }
        }

        return $phoneNumber;
    }
}