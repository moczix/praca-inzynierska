<?php namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;

use Auth;


class JobLog extends Model{


	protected $table = 'job_log';
    protected $fillable = array('log_id','job_id','uuid','result');
	//protected $hidden = ['password', 'activate_token'];
	public  $timestamps = false;
	protected $primaryKey = 'log_id';
		

	public function user()
	{
		return $this->hasOne('App\Http\Models\User', 'uuid','uuid');
	}
	
	
	public function deleteHistory($id)
	{
		try
		{
			$jobLog = JobLog::find($id);
			$jobLog->delete();
		}
		catch(\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
		
	}
		
	public function getDetails($id)
	{
		try
		{
			$jobLog = JobLog::find($id);
			return print_r(json_decode($jobLog->result,true),true);
		}
		catch(\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}	
		
		
	public function addNew()
	{
		try
		{
			$log = new JobLog();
			$log->job_id = Input::get('job');
			$log->result = Input::get('result');
			$log->uuid = Auth::id();
			$log->date = time();
			$log->save();
		}
		catch(\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	
	public function getHistoryByUser($id)
	{
		return JobLog::where('uuid',$id)->get();
	}
	
	public function getHistory($id)
	{
		return JobLog::where('job_id',$id)->get();
	}

	
		
		
}
