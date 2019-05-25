<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class ProductCateEditRequest extends Request {

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
			'txtName' => 'required',
		];
	}
	public function messages()
	{
		return [
			'txtName.required' => 'Bạn chưa nhập tên danh mục',
		];
	}
}
