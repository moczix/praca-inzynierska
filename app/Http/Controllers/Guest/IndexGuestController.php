<?php namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Models\User;


use App\Http\Requests\RegisterFormValidation;
use App\Http\Requests\LoginFormValidation;
use Illuminate\Http\JsonResponse;


use Auth;
use Redirect;

class IndexGuestController extends Controller {

	public function index()
	{
		$dane = [];
		return view('guest/index', $dane);
	}
	

	
	
	public function logout(){
		if(Auth::check()){
			Auth::logout();
			return Redirect('/');
		}
	}
	
	
	public function activateAccount($code){
		$user = new User();
		try{
			$dane['goodMsg'] = $user->activate($code);
			return view('guest/index');
		}catch(\Exception $e){
			$dane['badMsg'] = $e->getMessage();
			return view('guest/index');
		}
	}
	
	
	public function register(RegisterFormValidation $request){
		$user = new User();
		try{
			return $user->addNew();
		}catch(\Exception $e){
			return new JsonResponse(['msg'=>$e->getMessage()], 422);
		}
	}
	
	public function login(LoginFormValidation $request){
		$user = new User();
		try{
			$user->login();
		}catch(\Exception $e){
			return new JsonResponse(['msg'=>$e->getMessage()], 422);
		}
	}

}
