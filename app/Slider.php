<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{

    use Linkable, Sortable, Attributes, InteractsWithMedia, SoftDeletes;

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
    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('thumb')->width(240)->performOnCollections('*');

        $this->addMediaConversion('medium')->width(800)->performOnCollections('*');

        $this->addMediaConversion('full')->width(1024)->performOnCollections('*');

        $this->addMediaConversion('extralarge')->width(1200)->performOnCollections('*');

        $this->addMediaConversion('adminThumb')->width(100)->sharpen(15)->performOnCollections('*');
    }

}
