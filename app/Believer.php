<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Believer
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property text $address
 * @property integer $phone_number
 * @property string $email
 * @property string $date_of_birth
*/
class Believer extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'address', 'phone_number', 'email', 'date_of_birth'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPhoneNumberAttribute($input)
    {
        $this->attributes['phone_number'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateOfBirthAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_of_birth'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateOfBirthAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
}
