<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;
use Auth;

use Session;

class HeaderComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$login = (Auth::check())? 1 :0 ;
		$admin = 0;
		if($login){
			$admin = (Auth::user()->admin)? 1 : 0;
		}
		

		
		
        $view->with('login', $login)->with('admin', $admin);
    }

}