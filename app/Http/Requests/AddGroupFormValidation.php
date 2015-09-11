<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Validator;

use Illuminate\Support\Facades\Lang;

class AddGroupFormValidation extends FormRequest {

	public function rules()
	{
		return [
			'groupName' => 'required|min:3|max:25|alpha_num'
		];
	}
	
	public function messages()
	{
		return [
			'groupName.required'=> 'Nazwa wymagana',
			'groupName.min' => 'Nazwa musi zawieraæ minimum :min znaki',
			'groupName.max' => 'Nazwa musi zawieraæ max :max znaki',
			'groupName.alpha_num' => 'Nazwa musi zawieraæ znaki alfanumeryczne'
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
