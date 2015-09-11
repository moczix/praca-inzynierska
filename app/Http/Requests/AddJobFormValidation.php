<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Validator;

use Illuminate\Support\Facades\Lang;

class AddJobFormValidation extends FormRequest {

	public function rules()
	{
		return [
			'name' => 'required|min:3|max:25',
			'text' => 'required',
			'attempt'=>'numeric',
			'breakDay'=>'numeric',
			'breakHour'=>'numeric',
			'breakMinute'=>'numeric',
		];
	}
	
	public function messages()
	{
		return [
			'name.required'=> 'Nazwa Wymagana',
			'name.min' => 'Nazwa musi zawierać minimum :min znaków',
			'name.max' => 'Nazwa może zawierać max :max znaków',
			
			'text.required'=> 'Treść wymagana',
			
			'attempt.numeric' => 'Próby muszą być numerem',
			'breakDay.numeric' =>'Dni muszą być numerem',
			'breakMinute.numeric' => 'Minuty muszą być numerem'
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
