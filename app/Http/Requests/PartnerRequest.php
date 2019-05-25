<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PartnerRequest extends Request {

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
			'name' => 'required|unique:partner,name',
            'fImages' => 'image|max:200000'
		];
	}
	public function messages()
	{
		return [
			'name.required' => 'Bạn chưa nhập tên đối tác',
            'fImages.max' => 'Ảnh bạn upload đã vượt quá dung lượng cho phép',
		];
	}

}
