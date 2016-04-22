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
			$dane = json_decode($jobLog->result,true);
			
			
			$correct = [];
			$incorrect = [];
			$improve = [];

			if(!empty($dane['attempt']['correct']))
			{
				foreach($dane['attempt']['correct'] as $as)// po poprawnych
				{
					$string = "";
					foreach($as as $sa)
					{
						$string .= '{';
						foreach($sa as $zz)
						{
							$string .= $zz.',';
						}	
						$string = substr($string, 0, -1);
						$string .= '},';						
					}
					$string = substr($string, 0, -1);
					$correct[] = $string ;
				}	
			}
			
			
			if(!empty($dane['attempt']['incorrect']))
			{
				foreach($dane['attempt']['incorrect'] as $as)// po poprawnych
				{
					$string = "";
					foreach($as as $sa)
					{
						$string .= '{';
						foreach($sa as $zz)
						{
							$string .= $zz.',';
						}	
						$string = substr($string, 0, -1);
						$string .= '},';						
					}
					$string = substr($string, 0, -1);
					$incorrect[] = $string ;
				}	
			}
			
			if(!empty($dane['attempt']['improve']))
			{
				foreach($dane['attempt']['improve'] as $as)// po poprawnych
				{
					$string = "";
					foreach($as as $sa)
					{
						$string .= '{';
						foreach($sa as $zz)
						{
							$string .= $zz.',';
						}	
						$string = substr($string, 0, -1);
						$string .= '},';						
					}
					$string = substr($string, 0, -1);
					$improve[] = $string ;
				}	
			}


			$newArray = array("job"=>$dane['job'], "nazwa"=>$dane['name'], "tekst"=>$dane['text'], "attempts"=>array("correct"=>$correct ,"incorrect"=>$incorrect ,"improve"=>$improve));
			echo '<pre>';
			 return print_r($newArray,true);
			echo '</pre>';
			//return print_r(json_decode($jobLog->result,true),true);
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
		return JobLog::where('uuid',$id)->paginate(30);
	}
	
	public function getHistory($id)
	{
		return JobLog::where('job_id',$id)->get();
	}

	
		
		
}
