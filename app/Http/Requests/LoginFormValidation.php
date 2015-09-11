<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Validator;

use Illuminate\Support\Facades\Lang;

class LoginFormValidation extends FormRequest {

	public function rules()
	{
		return [
			'username' => 'required',
			'password' => 'required'
		];
	}
	
	public function messages()
	{
		return [
			'username.required'=> Lang::get('msg.usernameReq'),
			'password.required' => Lang::get('msg.password1Req')
		];
		
	}
	
	public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }
	
	public function response(array $errors)
    {
		if ($this->ajax() || $this->wantsJson())
		{
			return new JsonResponse($errors, 422);
		}
		return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
    }
	
	

}
