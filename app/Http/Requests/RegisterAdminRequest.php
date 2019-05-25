<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterAdminRequest extends Request {

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
			'username' => 'required|unique:users,username',
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'repassword' => 'required'
		];
	}
	public function messages()
	{
		return [
			'username.required' => 'Vui lòng nhập username',
			'name.required' => 'Vui lòng nhập họ tên',
			'email.required' => 'Vui lòng nhập email',
			'email.email' => 'Vui lòng nhập đúng định dạng email',
			'email.unique' => 'Email đã tồn tại',
			'password.required' => 'Vui lòng nhập password',
			'repassword.required' => 'Vui lòng nhập lại password',
            
		];
	}

}
