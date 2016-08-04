<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Slider extends Model implements HasMediaConversions
{

    use Linkable, Sortable, Attributes, HasMediaTrait, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * Autoload Relationships
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url'
    ];

    /**
     * Convert Images
     */
    public function registerMediaConversions()
    {

        $this->addMediaConversion('thumb')->setManipulations(['w' => 240])->performOnCollections('sliders');

        $this->addMediaConversion('medium')->setManipulations(['w' => 1080])->performOnCollections('sliders');

        $this->addMediaConversion('adminThumb')->setManipulations(['w' => 100, 'sharp' => 15])->performOnCollections('*');
    }

}
