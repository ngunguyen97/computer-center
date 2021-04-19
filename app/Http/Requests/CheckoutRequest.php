<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
          'email' => 'required|email',
          'fullname' => 'required',
          'id_card' => 'required|regex:/[0-9]{9}/',
          'address' => 'required',
          'phone' => 'required|regex:/(0)[0-9]{9}/'
        ];
    }

    public function messages() {
      return [
        'fullname.required' => 'Vui lòng nhập họ và tên.',
        'email.required' => 'Vui lòng nhập email,',
        'address.required' => 'Vui lòng nhập địa chỉ',
        'phone.required' => 'Vui lòng nhập số điện thoại',
        'phone.regex' => 'Số điện thoại không hơp lệ.',
        'id_card.required' => 'Vui lòng nhập chứng minh nhân dân',
        'id_card.regex' => 'Chứng minh thư không hợp lệ'
      ];
    }
}
