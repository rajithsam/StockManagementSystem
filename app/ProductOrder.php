<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductOrder
 *
 * @package App
 * @property string $product
 * @property integer $quantity
 * @property string $order_date
*/
class ProductOrder extends Model
{
    use SoftDeletes;

    protected $fillable = ['quantity', 'order_date', 'product_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProductIdAttribute($input)
    {
        $this->attributes['product_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setQuantityAttribute($input)
    {
        $this->attributes['quantity'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setOrderDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['order_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['order_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getOrderDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
    
}
