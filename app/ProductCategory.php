<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductCategory
 *
 * @package App
 * @property string $category
*/
class ProductCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['category'];
    
    
}
