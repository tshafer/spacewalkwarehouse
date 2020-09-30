<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Node implements HasMedia
{

    use Linkable, Sortable, Attributes, HasSlug, InteractsWithMedia, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
        'intro_text',
        'enabled',
        'title',
    ];

    /**
     * With Baum, all NestedSet-related fields are guarded from mass-assignment
     * by default.
     *
     * @var array
     */
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Columns which restrict what we consider our Nested Set list
     *
     * @var array
     */
    protected $scoped = [];


   /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    
    /**
     * Convert Images
     */
    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('thumb')->width(240)->performOnCollections('*');

        $this->addMediaConversion('medium')->width(800)->performOnCollections('*');

        $this->addMediaConversion('full')->width(1024)->performOnCollections('*');

        $this->addMediaConversion('adminThumb')->width(100)->sharpen(15)->performOnCollections('*');
    }


    /**
     * @return mixed
     */
    public function productsEnabled()
    {
        return $this->products()->enabled();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id')->orderBy('position', 'asc');
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
        if (array_key_exists('enabled', $this->attributes)) {
            return ($this->attributes['enabled'] == 0) ? 'No' : 'Yes';
        }
    }
}
