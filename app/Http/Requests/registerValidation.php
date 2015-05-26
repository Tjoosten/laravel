<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class registerValidation extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'firstname'  => 'required',
			'lastname'   => 'required',
			'birth'      => 'required',
			'address'    => 'required',
			'education'  => 'required',
			'job'        => 'required',
			'email'      => 'required',
		];
	}

	/**
	 * Get the validation error messages.
	 *
	 * @return array.
	 */
	public function messages() {
		return [
			'firstname.required' => Lang::get('validation.required');
			'lastname.required'  => Lang::get('validation.required');
			'birth.required'     => Lang::get('validation.required');
			'address.required'   => Lang::get('validation.required');
			'education.required' => Lang::get('validation.required');
			'job.required'       => Lang::get('validation.required');
			'email.required'     => Lang::get('validation.required');
		];
	}

}
