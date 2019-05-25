<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'txtName' => 'required|min:2|max:100',
            'txtAlias' => 'required',
            'filesTest' => 'file|max:10240',
        ];
    }
    public function messages()
    {
        return [
            'txtName.required' => 'Bạn chưa nhập tên ',
            // 'txtName.unique' => 'Tên bài viết bị trùng, mời nhập lại',
            'txtName.min' => 'Tên phải có đội dài từ 2 đến 100 ký tự',
            'txtName.max' => 'Tên phải có đội dài từ 2 đến 100 ký tự',
            'txtAlias.required' => 'Bạn chưa nhập liên kết bài viết',
            'filesTest.max' => 'Dung lượng file không vượt quá 10MB'
        ];
    }
}
