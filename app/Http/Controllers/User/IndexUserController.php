<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use \App\Http\Models\User;
use \App\Http\Models\Group;
use \App\Http\Models\Job;
use \App\Http\Models\JobLog;
use \App\Http\Models\JobBreak;

use Auth;
use Redirect;

use Illuminate\Http\JsonResponse;


use App\Http\Requests\ChangePasswordFormValidation;

use App\Http\Requests\ChangeEmailFormValidation;




class IndexUserController extends Controller {



	function __construct()
	{
		$break = new JobBreak();
		$break->checkEndBreak();
		
	}

	public function index()
	{
		$job = new Job();
		$dane = ['jobAv'=>$job->availableJobs(), "Counter"=>1];
		return view('user/panelPage',$dane);
	}
	
	
	public function changeSettings()
	{
		$user = new User();
		try
		{
			$user->changeSettings();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
	}
	
	public function userSettings()
	{
		$jobLog = new JobLog();
		$user = new User();
		$group = new Group();
		$dane = ["history"=>$jobLog->getHistoryByUser(Auth::id()),"Counter"=>1, "user"=>$user->info(Auth::id()), "groupSelectOption"=>$group->groupSelectArray(), "settings"=>$user->getSettings(Auth::id())];
		return view('user/userProfil',$dane);
	}
	
	
	public function changePasswordUser(ChangePasswordFormValidation $request)
	{
		$user = new User();
		try
		{
			$user->changePassword();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
	}
	
	public function changeEmailUser(ChangeEmailFormValidation $request)
	{
		$user = new User();
		try
		{
			$user->changeEmail();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
	}
	
	
	public function getHistory($id)
	{
		$jobLog = new JobLog();
		try
		{
			return $jobLog->getDetails($id);
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
	}


	public function doJobPage($id)
	{
		$job = new Job();
		$dane = ["dane"=>$job->info($id)];
		return view('user/doJobPage',$dane);
	}
	
	public function completeJob()
	{
		$job = new Job();
		try
		{
			$job->complete();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
		
	}



}
