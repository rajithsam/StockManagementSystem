<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @package App
 * @property string $product_name
 * @property string $product_category
 * @property text $product_description
 * @property integer $in_stock
*/
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_name', 'product_description', 'in_stock', 'product_category_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProductCategoryIdAttribute($input)
    {
        $this->attributes['product_category_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setInStockAttribute($input)
    {
        $this->attributes['in_stock'] = $input ? $input : null;
    }
    
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id')->withTrashed();
    }
    
}
