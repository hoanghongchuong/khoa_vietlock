<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GioithieuRequest extends FormRequest
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
            'txtName' => 'required|unique:gioithieu,name',
            'txtAlias' => 'required',
            
        ];
    }
    public function messages()
    {
        return [
            'txtName.required' => 'Bạn chưa nhập tên sản phẩm',
            'txtName.unique' => 'Tên bài viết bị trùng, mời nhập lại',
            'txtAlias.required' => 'Bạn chưa nhập liên kết bài viết',
            
        ];
    }
}
