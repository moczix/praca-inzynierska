<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


use \App\Http\Models\Job;
use \App\Http\Models\JobBreak;

use Auth;
use Redirect;

use Illuminate\Http\JsonResponse;

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
