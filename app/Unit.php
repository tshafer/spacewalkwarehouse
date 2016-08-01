<?php
namespace App;

use App\Support\Traits\Attributes;
use App\Support\Traits\Linkable;
use App\Support\Traits\Sortable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Unit extends Model implements Buyable
{

    use Linkable, Sortable, Attributes, Eloquence;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'units';

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
        'price',
        'model',
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchableColumns = [
        'description'         => 20,
        'name'                => 10,
        'model'               => 10,
        'weight'              => 10,
        'product.name'        => 10,
        'product.description' => 5,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitRequests()
    {
        return $this->belongsToMany(UnitRequest::class);
    }


    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier()
    {
        return $this->id;
    }


    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription()
    {
        return $this->description;
    }


    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice()
    {
        return $this->price;
    }


    /**
     * @param $price
     *
     * @return mixed
     */
    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = number_format($price, 2);
    }


    /**
     * @param $price
     *
     * @return mixed
     */
    public function getPriceAttribute($price)
    {
        return number_format((float)$price, 2);
    }
}
