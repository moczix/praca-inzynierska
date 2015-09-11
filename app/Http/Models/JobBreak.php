<?php namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;

use Auth;

class JobBreak extends Model{


	protected $table = 'job_break';
    protected $fillable = array('break_id','job_id','uuid','time_end');
	//protected $hidden = ['password', 'activate_token'];
	public  $timestamps = false;
	protected $primaryKey = 'break_id';
		
		
		
	public function checkEndBreak()
	{
		JobBreak::where('time_end','<',time())->delete();
	}
		
		
	public function addNew($break,$job)
	{
		
		$breakS = new JobBreak();
		$breakS->job_id = $job;
		$breakS->uuid = Auth::id();
		$breakS->time_end = time()+$break;
		$breakS->save();	
			
	}

	public static function checkBreak($id)
	{
		$break = JobBreak::find($id);
		if(count($break))
		{
			return true;
		}		
		else
		{
			return false;
		}
		
	}

	
		
		
}
