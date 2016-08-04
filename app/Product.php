<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MartinBean\Database\Eloquent\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMediaConversions
{

    use Linkable, Sortable, Attributes, Sluggable, HasMediaTrait, SoftDeletes, CascadeSoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Delete units when a product is deleted
     *
     * @var array
     */
    protected $cascadeDeletes = ['units', 'media'];

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
        'name',
        'description',
        'enabled',
        'slug',
        'season',
    ];


    /**
     * Convert Images
     */
    public function registerMediaConversions()
    {

        $this->addMediaConversion('thumb')->setManipulations(['w' => 240])->performOnCollections('*');

        $this->addMediaConversion('medium')->setManipulations(['w' => 800])->performOnCollections('*');

        $this->addMediaConversion('full')->setManipulations(['w' => 1024])->performOnCollections('*');

        $this->addMediaConversion('adminThumb')->setManipulations(['w' => 100, 'sharp' => 15])->performOnCollections('*');

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }


    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }


    /**
     * @return string
     */
    public function getIsEnabledAttribute()
    {
        return ($this->attributes['enabled'] == 0) ? 'No' : 'Yes';
    }

}
