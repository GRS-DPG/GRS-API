<?php

namespace App\Http\Requests\Complainant;

use Illuminate\Foundation\Http\FormRequest;

class NewComplainantRequest extends FormRequest
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
            'name' => 'required',
            'mobile_number' => 'required|regex:/(01)[0-9]{9}/|unique:complainants,mobile_number',
            'identification_value' => 'required',
            'entity_registration_date' => 'date|nullable',
            'permanent_address_street'=>'required',
            'email' => 'email|nullable|unique:complainants,email',
            // 'user.password' => [
            //     'required',
            //     'confirmed',
            //     'min:8',
            //     'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/' // Should have at least 1 lowercase AND 1 uppercase AND 1 number AND 1 symbol
            // ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Full Name field is required.',
            'identification_value.required' => 'Identification field is required.',
            'mobile_number.required' => 'Mobile Number field is required.',
            'permanent_address_street.required' => 'Address field is required.',
        ];
    }
}
