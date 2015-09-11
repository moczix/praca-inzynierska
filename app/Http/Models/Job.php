<?php namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;

use Auth;


class Job extends Model{


	protected $table = 'job';
    protected $fillable = array('job_id','name','job','attempt','break','active');
	//protected $hidden = ['password', 'activate_token'];
	public  $timestamps = false;
	protected $primaryKey = 'job_id';
		

	public function complete()
	{
		try
		{
			$job = Job::find(Input::get('job'));
			if(!JobBreak::checkBreak(Input::get('job')))
			{
				$jobLog = new JobLog();
				try
				{
					$jobLog->addNew();
					if($job->break > 0)
					{
						$jobBreak = new JobBreak();
						$jobBreak->addNew($job->break,$job->job_id);
					}
				}
				catch(\Exception $e)
				{
					throw new \Exception($e->getMessage());
				}
			}else throw new \Exception("Niestety to zadanie jest już nieaktywne");
			
		}
		catch(\Exception $e)
		{
			throw new \Exception("Nie hakuj!".$e->getMessage());
		}
		
		
	}
		
	public function info($id)
	{
		return Job::find($id);
	}	
		
		
	public function availableJobs()
	{
		$jobs = Job::all()->toArray();
		$jober = [];
		foreach($jobs as $jb)
		{
			if(!JobBreak::checkBreak($jb['job_id']))
			{
				$jober[] = $jb;
			}
		}
		return (object) $jober;
	}

		
	public function edit()
	{
		try
		{
			$job = Job::find(Input::get('jobDt'));
			$break = (Input::get('breakDay') * 24 * 60 * 60 ) + (Input::get('breakHour') * 60 * 60 ) + (Input::get('breakMinute') * 60 );
			$job->name = Input::get('name');
			$job->job = Input::get('text');
			$job->attempt = Input::get('attempt');
			$job->break = $break;
			$job->active = 1;
			$job->save();
		}
		catch(\Exception $e)
		{
			throw new \Exception("Nie Hakuj");
		}
		
	}
		
		
	public function addNew()
	{
		$break = (Input::get('breakDay') * 24 * 60 * 60 ) + (Input::get('breakHour') * 60 * 60 ) + (Input::get('breakMinute') * 60 );
		
		$job = new Job();
		$job->name = Input::get('name');
		$job->job = Input::get('text');
		$job->attempt = Input::get('attempt');
		$job->break = $break;
		$job->active = 1;
		$job->save();
	}
	
	
	
	public function jobList()
	{
		
		return Job::all();
	}

	public function changeStatus($id)
	{
		try
		{
			$job = Job::find($id);
			if($job->active == 1) 
			{
				$job->active = 0;
			}
			else
			{
				$job->active = 1;
			}
			$job->save();
		}catch(\Exception $e){}
	}
	
	public function delJob($id)
	{
		$job = Job::find($id);
		if(count($job)){
			JobLog::where('job_id',$id)->delete();
			JobBreak::where('job_id',$id)->delete();
			$job->delete();
		}
	}
	
	
	
			
	
		
		
}
