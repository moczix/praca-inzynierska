<?php namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;


class Group extends Model{


	protected $table = 'group';
    protected $fillable = array('group_id','name');
	//protected $hidden = ['password', 'activate_token'];
	public  $timestamps = false;
	protected $primaryKey = 'group_id';
		

		public function userCount()
		{
		  return $this->hasOne('App\Http\Models\User', 'group_id', 'group_id')
			->selectRaw('group_id, count(*) as aggregate')
			->groupBy('group_id');
		}
		 
		public function getUserCountAttribute()
		{
		  // if relation is not loaded already, let's do it first
		  if ( ! array_key_exists('userCount', $this->relations)) 
			$this->load('userCount');
		 
		  $related = $this->getRelation('userCount');
		 
		  // then return the count directly
		  return ($related) ? (int) $related->aggregate : 0;
		}	
		
	
	
	public function groupSelectArray()//zwraca array
	{
		$group = Group::all();
		$array = [];
		$array[0] = 'brak';
		if(!empty($group))
		{
			foreach($group as $gr)
			{
				$array[$gr->group_id] = $gr->name;
			}
		}
		return $array;
		
	}
	
	
	
	
	public function delGroup($id)
	{
		
		$group = Group::find($id);
		if(count($group)){
			User::where('group_id',$id)->update(['group_id'=>0]);
			$group->delete();
		}
		
	}
	
	public function addNew()
	{
		$exist = Group::where('name',Input::get('groupName'))->count();
		if(!$exist){
			$kat = new Group();
			$kat->name = Input::get('groupName');
			$kat->save();
		}else throw new \Exception('Istnieje już grupa o tej nazwie');
	}
	
	
	public function groupList()
	{
		$category = Group::with('userCount')->get();
		return $category;
	}
	


	
		
		
}
