<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class MenuRequest extends Request {

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
			'txtName' => 'required|unique:news_categories,name',
		];
	}
	public function messages()
	{
		return [
			'txtName.required' => 'Bạn chưa nhập tên menu',
            'txtName.unique' => 'Tên menu bị trùng, mời nhập lại'
		];
	}
}
