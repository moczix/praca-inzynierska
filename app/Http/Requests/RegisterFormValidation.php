<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Validator;

use Illuminate\Support\Facades\Lang;

class RegisterFormValidation extends FormRequest {

	public function rules()
	{
		return [
			'username' => 'required|min:3|max:25|alpha_num',
			'email'=> 'required|email',
			'password1' => 'required',
			'password2'=>'required'
		];
	}
	
	public function messages()
	{
		return [
			'username.required'=> Lang::get('msg.usernameReq'),
			'username.min' => Lang::get('msg.usernameMin', ['min'=> ':min']),
			'email.required' =>Lang::get('msg.emailReq'),
			'email.email'=>Lang::get('msg.emailInvalid'),
			'password1.required' => Lang::get('msg.password1Req'),
			'password2.required' =>Lang::get('msg.password2Req'),
			'username.alpha_num' => Lang::get('msg.usernameAlphaNum')
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
