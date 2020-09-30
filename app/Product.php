<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Czim\Listify\Listify;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements HasMedia, Searchable
{

    use Linkable, Sortable, Attributes, HasSlug, InteractsWithMedia, SoftDeletes, Listify;
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
    protected $with = ['media', 'categories'];


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
        'featured',
        'position',
        'categories_id'
    ];

    public function __construct(array $attributes = array(), $exists = false) {

        parent::__construct($attributes, $exists);

        $this->initListify([
            'scope' => $this->categories()
        ]);
    }


    public function getSearchResult(): SearchResult
    {
        $url = route('product', [$this->categories->slug, $this->slug]);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

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

        $this->addMediaConversion('thumb')->height(150)->width(50)->fit('crop', 150, 150)->performOnCollections('products');

        $this->addMediaConversion('category_page')->height(277)->width(300)->fit('fill', 300, 277)->performOnCollections('products');

        $this->addMediaConversion('accessories')->height(250)->performOnCollections('accessories');

        $this->addMediaConversion('medium')->width(800)->performOnCollections('*');

        $this->addMediaConversion('full')->width(1024)->performOnCollections('*');

        $this->addMediaConversion('adminThumb')->width(240)->performOnCollections('*');

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
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


    /**
     * @return string
     */
    public function getIsFeaturedAttribute()
    {
        return ($this->attributes['featured'] == 0) ? 'No' : 'Yes';
    }

}
