<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\User;
use App\Http\Models\Group;
use App\Http\Models\Job;
use App\Http\Models\JobLog;
use App\Http\Models\JobBreak;

use App\Http\Requests\RegisterByAdminFormValidation;
use App\Http\Requests\AddGroupFormValidation;
use App\Http\Requests\AddJobFormValidation;
use App\Http\Requests\EditJobFormValidation;

use App\Http\Requests\ChangePasswordFormValidation;

use App\Http\Requests\ChangeEmailFormValidation;

use Illuminate\Http\JsonResponse;

use Auth;
use Redirect;

class IndexAdminController extends Controller {

	public function index()
	{
		$job = new Job();
		$dane = ["jobs"=>$job->jobList(),"Counter"=>1];
		return view('admin/index',$dane);
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
	
	
	
	public function showUser($id)
	{
		$jobLog = new JobLog();
		$user = new User();
		$group = new Group();
		$dane = ["history"=>$jobLog->getHistoryByUser($id),"Counter"=>1, "user"=>$user->info($id), "groupSelectOption"=>$group->groupSelectArray(), "settings"=>$user->getSettings($id)];
		return view('admin/userProfil',$dane);
	}
	
	public function deleteHistory($id)
	{
		$jobLog = new JobLog();
		try
		{
			$jobLog->deleteHistory($id);
			return redirect::back();
		}
		catch(\Exception $e){}
		
		
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
	
	
	public function showJobHistory($id)
	{
		$jobLog = new JobLog();
		$dane = ["history"=>$jobLog->getHistory($id),"Counter"=>1];
		
		
		return view('admin/JobHistory',$dane);
	}
	
	
	public function members()
	{
		$user = new User();
		$group = new Group();
		$dane = ['usersList'=>$user->usersList(),
		"userCounter"=>1, 
		"userACounter"=>1, 
		"userNCounter"=>1, 
		"groupSelectOption"=>$group->groupSelectArray(), 
		"usersListActive"=>$user->activeUserList(), 
		"usersListNoActive"=>$user->noActiveUserList()		
		];
		return view('admin/userList',$dane);
		
	}
	
	public function groups()
	{
		$group = new Group();
		$dane = ['groupList'=>$group->groupList(), "Counter"=>1];
		return view('admin/groupList',$dane);
	}
	
	public function delJob($id)
	{
		$job = new Job();
		$job->delJob($id);
		return redirect::back();
	}
	
	public function changeJobStatus($id)
	{
		$job = new Job();
		$job->changeStatus($id);
		return redirect::back();
	}
	
	public function editJob(EditJobFormValidation $request)
	{
		$job = new Job();
		try
		{
			$job->edit();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
		
		
	}
	
	
	public function addJob(AddJobFormValidation $request)
	{
		$job = new Job();
		try
		{
			$job->addNew();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}		
	}
	
	public function chooseGroup()
	{
		$user = new User();
		try
		{
			$user->chooseGroup();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
	}
	
	
	public function delGroup($id)
	{
		$group = new Group();
		$group->delGroup($id);
		return redirect::back();
		
		
	}
	
	public function addNewGroup(AddGroupFormValidation $request)
	{
		$group = new Group();
		try
		{
			$group->addNewGroup();
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()],422);
		}
		
	}
	
	public function addNewUser(RegisterByAdminFormValidation $request)
	{
		$user = new User();
		try
		{
			$user->addNew(1);
		}
		catch(\Exception $e)
		{
			return new JsonResponse(['msg'=>$e->getMessage()], 422);
		}
	}
	
	
	public function changeUserStatus($id)
	{
		$user = new User();
		$user->changeStatus($id);
		
		return Redirect::back();
	}
	
	
	
	
	
}