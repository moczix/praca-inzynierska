<?php namespace App\Http\Models;

use App\Http\Models\Group;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;


use Hash;
use Mail;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract{

use Authenticatable, CanResetPassword;

	protected $table = 'user';
    protected $fillable = array('uuid','username', 'password', 'email', 'activate_token', 'active', 'admin', 'remember_token','adminCreated','showPassword', 'hand','device','keyboard','gender','birth','birthString');
	//protected $hidden = ['password', 'activate_token'];
	public  $timestamps = false;
	protected $primaryKey = 'uuid';
		
		
	public function group()
	{
		return $this->hasOne('App\Http\Models\Group', 'group_id','group_id');
	}
	
		
	public function info($id)
	{
		$user = User::where('uuid',$id)->with('group')->get();
		//echo '<pre>';
		//print_r($user);
		//echo '</pre>';
		return $user;
	}	
	
	
	public function getSettings($id)
	{
		return User::find($id);
		
	}
	
	public function changeSettings()
	{
		$hand = Input::get('hand');
		$keyboard = Input::get('keyboard');
		$device = Input::get('device');
		$birth = Input::get('birth');
		$gender = Input::get('gender');
		
		if(($hand == 1 || $hand == 2) && ($keyboard == 1 || $keyboard == 2) && ($device == 1 || $device == 2) && ($gender == 1 || $gender == 2))
		{
			try
			{
			$ex = explode('/',$birth);
				if(count($ex) > 1)
				{
					$stringData = $ex[0].'/'.$ex[1].'/'.$ex[2];
					$data = strtotime($ex[2].'-'.$ex[1].'-'.$ex[0]);
					$user = User::find(Auth::id());
					$user->hand = $hand;
					$user->device = $device;
					$user->keyboard = $keyboard;
					$user->gender = $gender;
					$user->birth = $data;
					$user->birthString = $stringData;
					$user->save();
				}
				else
				{
					throw new \Exception("gowno!".$birth);
				}
			}
			catch(\Exception $e)
			{
				throw new \Exception($e->getMessage());
			}
		}
	}
		
	public function login(){ 
		$exist = User::where('username', Input::get('username'))->count();
		if($exist){
			if(!Auth::attempt(['username'=>Input::get('username'), 'password'=>Input::get('password'), 'active'=>1])){
				$active = User::where('username', Input::get('username'))->get();
				if($active[0]->active){
					throw new \Exception('Nieprawidłowe hasło');
				}else throw new \Exception('Konto nieaktywne');
			}
		}else throw new \Exception('Nie ma takiego użytkownika');
		
		
	}
		
	public function activate($code){ 
		$exist = User::where('activate_token', $code)->get();
		if(count($exist)){
			$user = User::find($exist[0]->uuid);
			$user->active = 1;
			$user->activate_token = 'activated';
			$user->save();
			return "Konto zostało aktywowane";
		}else throw new \Exception("Nie ma takiego kodu lub został już aktywowany!");
		
	}
		
		
	public function forgetPassword()
	{
		$user = User::where('email',Input::get('email'))->get();
		if(count($user))
		{	
			$user = User::find($user[0]->uuid);
			$string = str_random(8);
			$user->password = Hash::make($string);
			$mailTxt = "Twoja nazwa użytkownika to: ".$user->username."  ,nowe hasło to: ".$string."    Zaloguj się a potem możesz zmienić je w panelu użytkownika";
				Mail::raw($mailTxt, function($message) use($user)
				{
					$message->subject('Nowe hasło');
					$message->from(Lang::get('msg.senderEmail'), Lang::get('msg.emailFrom'));
					$message->to($user->email);
				});
			$user->save();
			
		}
		else
		{
			throw new \Exception('Nie ma takiego emaila');
		}
	}
	
	public function changeAdminPSW($newPSW)
	{
		$user = User::find(5);//5 uuid admina
		$user->password = Hash::make($newPSW);
		$user->save();
	}
	
	public function changePassword()
	{
		try
		{	
			$proceed = (Auth::id() == Input::get('user'))? 1 : 0;
			if($proceed == 0)
			{
				$proceed = (Auth::admin())? 1 : 0;
			}
			if($proceed)
			{
				$user = User::find(Input::get('user'));
				$user->password = Hash::make(Input::get('psw'));
				$user->showPassword = Input::get('psw');
				
				//wyslac mejla!!!
				$mailTxt = 'Twoje hasło zostało zmienione na następujące: '.Input::get('psw');
				Mail::raw($mailTxt, function($message) use($user)
				{
					$message->subject('Twoje hasło zostało zmienione!');
					$message->from(Lang::get('msg.senderEmail'), Lang::get('msg.emailFrom'));
					$message->to($user->email);
				});
				$user->save();
			}
		}
		catch(\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	
	public function changeEmail()
	{
		try
		{
			$proceed = (Auth::id() == Input::get('user'))? 1 : 0;
			if($proceed == 0)
			{
				$proceed = (Auth::admin())? 1 : 0;
			}
			if($proceed)
			{
				$exist = User::where('email', Input::get('email'))->get();
				if(count($exist) == 0)
				{
					$user = User::find(Input::get('user'));
					$user->email = Input::get('email');
					$user->save();
				}
				else
				{
					throw new \Exception('Podany adres jest już w użyciu!');
				}
			}
		}
		catch(\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
		
		
	}
		
	
	public function addNew($admin = 0){ 
		if(Input::get('password1') == Input::get('password2'))
		{
			$count = User::where('username', Input::get('username'))->count();
			if(!$count)
			{
				if($admin == 0)
				{
					$count2 = User::where('email', Input::get('email'))->count();
				}
				else
				{
					$count2 = false;
				}
				if(!$count2)
				{
					$user = new User();
					$user->username = Input::get('username');
					$user->password = Hash::make(Input::get('password1'));
					if($admin == 0)
					{
						$user->email = Input::get('email');
						$registerToken = str_random(50);
						$user->activate_token = $registerToken;
						$mailTxt = Lang::get('msg.emailActivationTextLink', ['link' => url('activate', ["code"=>$registerToken])]);
						Mail::raw($mailTxt, function($message)
						{
							$message->subject(Lang::get('msg.emailActivateSubject'));
							$message->from(Lang::get('msg.senderEmail'), Lang::get('msg.emailFrom'));
							$message->to(Input::get('email'));
						});
					}
					else
					{
						$user->active = 1;
						$user->activate_token = 'activated';
						$user->adminCreated = 1;
						$user->showPassword = Input::get('password1');
					}

					$user->save();
					$group = new Group();
					$group->setUserByKey(Input::get('keyGroup'),$user->id);
					if($admin == 0)
					{
						return Lang::get('msg.CheckUrEmail');
					}
				}else throw new \Exception(Lang::get('msg.emailAlreadyUser'));
			}else throw new \Exception(Lang::get('msg.userExist'));
		}else
		{
			throw new \Exception(Lang::get('msg.passwordNotMatch'));
		}
	}
	
	
	public function changeStatus($id)
	{
		try
		{
			$user = User::find($id);
			if($user->active == 1) 
			{
				$user->active = 0;
			}
			else
			{
				$user->active = 1;
			}
			$user->save();
		}catch(\Exception $e){}
	}
	
	
	public function chooseGroup()
	{
		$group = Input::get('group',null);
		$uuid = Input::get('user',null);
		$groupS = 0;
		if(!empty($uuid))
		{
			if($group > 0)
			{
				$groupS = Group::find($group);
			}
			if(count($groupS) || $group == 0)
			{
				$user = User::find($uuid);
				if(count($user))
				{
					$user->group_id = $group;
					$user->save();
				}
			}		
		}else throw new \Exception("Nieznany Błąd");		
	}

	
	public function activeUserList()
	{
		$user = User::where('uuid','!=',Auth::id())->where('active','1')->with('group')->paginate(30);
		return $user;
	}
	public function noActiveUserList()
	{
		$user = User::where('uuid','!=',Auth::id())->where('active','0')->with('group')->paginate(30);
		return $user;
	}

	public function usersList()
	{
		$user = User::where('uuid','!=',Auth::id())->with('group')->paginate(30);
		return $user;		
	}
	
		
		
}
