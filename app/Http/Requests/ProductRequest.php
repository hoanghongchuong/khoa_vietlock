<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'txtName' => 'required|unique:products,name',
            'txtAlias' => 'required',
            'fImages' => 'image|max:200000'
		];
	}
	public function messages()
	{
		return [
			'txtName.required' => 'Bạn chưa nhập tên sản phẩm',
            'txtName.unique' => 'Tên sản phẩm bị trùng, mời nhập lại',
            'txtAlias.required' => 'Bạn chưa nhập liên kết sản phẩm',
            'fImages.image' => 'Bạn chọn sai định dạng file ảnh',
            'fImages.max' => 'Ảnh bạn upload đã vượt quá dung lượng cho phép',
		];
	}

}
