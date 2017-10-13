<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductDelivery
 *
 * @package App
 * @property string $beleiver
 * @property string $product
 * @property string $date
 * @property integer $quantity
*/
class ProductDelivery extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'quantity', 'beleiver_id', 'product_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setBeleiverIdAttribute($input)
    {
        $this->attributes['beleiver_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProductIdAttribute($input)
    {
        $this->attributes['product_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setQuantityAttribute($input)
    {
        $this->attributes['quantity'] = $input ? $input : null;
    }
    
    public function beleiver()
    {
        return $this->belongsTo(Believer::class, 'beleiver_id')->withTrashed();
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
    
}
