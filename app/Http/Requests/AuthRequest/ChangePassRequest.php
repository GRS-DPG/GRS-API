<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
      'password' => [
        'required',
        'confirmed',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/' // Should have at least 1 lowercase AND 1 uppercase AND 1 number AND 1 symbol
      ],


    ];
  }

  public function messages()
  {
    return [
      'password.required' => 'Please select Password',


      //'user.password.required' => 'User password field is required.',
    ];
  }
}
