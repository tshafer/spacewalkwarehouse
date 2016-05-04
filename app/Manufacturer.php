<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Baum\Node;
use Illuminate\Database\Eloquent\Model;
use MartinBean\Database\Eloquent\Sluggable;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Manufacturer extends Model implements HasMediaConversions
{

    use Linkable, Sortable, Attributes, Sluggable, HasMediaTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'enabled',
        'slug'
    ];

    /**
     * Convert Images
     */
    public function registerMediaConversions()
    {

        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 240, 'h' => 160])
            ->performOnCollections('manufacturers');

        $this->addMediaConversion('adminThumb')
            ->setManipulations(['w' => 100, 'h' => 100, 'sharp'=> 15])
            ->performOnCollections('*');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * @return string
     */
    public function getIsEnabledAttribute()
    {
        return ($this->attributes['enabled'] == 0) ? 'No' : 'Yes';
    }
}
