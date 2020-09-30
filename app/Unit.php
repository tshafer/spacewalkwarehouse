<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Unit extends Model implements Buyable, Searchable
{

    use Linkable, Sortable, Attributes, SoftDeletes, CanBeBought;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * The attributes that casted
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'weight' => 'float'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'height',
        'width',
        'length',
        'weight',
        'grade',
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('product', [$this->product->categories->slug, $this->product->slug]);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unitRequests()
    {
        return $this->belongsToMany(UnitRequest::class);
    }

}
