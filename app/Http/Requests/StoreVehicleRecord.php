<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRecord extends FormRequest
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
            'vehicle_no'=> 'required|max:255',
            'customer_id'=> 'required',
            'sale_type_id'=>'required',
            'date_of_install'=>'required',
            'last_pay_date'=>'required',
            'last_pay_amount'=>'nullable|max:100',
            'renewal_date'=>'required',
            'renewal_amount'=>'nullable|max:100',
            'duration'=>'nullable|max:100',
            'agreed_rate'=>'nullable|max:100',
            'device_model'=>'nullable|max:255',
            'device_imei'=>'nullable|max:255',
            'sim_no'=>'nullable|max:255',
            'sales_person'=>'nullable',
            'remarks'=>'nullable'
        ];
    }
}
