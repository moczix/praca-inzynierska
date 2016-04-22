<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Validator;

use Illuminate\Support\Facades\Lang;

class ChangeEmailFormValidation extends FormRequest {

	public function rules()
	{
		return [
			'email' => 'required|email',
			'user'=>'required'
		];
	}
	
	public function messages()
	{
		return [
			'email.required'=> "Email wymagane!",
			'email.email' => 'Musisz podaæ prawid³owy email',
			'user.required' =>"Nie hakuj!"
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
