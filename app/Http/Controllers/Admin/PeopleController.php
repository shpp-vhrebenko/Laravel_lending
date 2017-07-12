<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\People;

class PeopleController extends Controller
{
    public function execute() {		
		
		if(view()->exists('admin.peoples')) {
			
			$peoples = People::all();
			
			$data = [
					
					'title' => 'Сотрудники',
					'peoples' => $peoples
					
					];
			
			return view('admin.peoples',$data);		
			
		}
		
		abort(404);
	}
}
