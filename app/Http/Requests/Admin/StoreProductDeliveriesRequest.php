<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductDeliveriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'beleiver_id' => 'required',
            'product_id' => 'required',
            'date' => 'required|date_format:'.config('app.date_format'),
            'quantity' => 'max:2147483647|required|numeric',
        ];
    }
}
