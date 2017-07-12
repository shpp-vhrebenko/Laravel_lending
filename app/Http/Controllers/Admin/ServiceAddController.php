<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\Service;

class ServiceAddController extends Controller
{
    //
    
    public function execute(Request $request) {
    	if($request->isMethod('post')) {
			$input = $request->except('_token');
			
			
			$massages = [
			
				'required'=>'Поле :attribute обязательно к заполнению',				
				'max'=>'Количество символов поля :attribute должно быть не больше :max',
			
			];
			
			
			$validator = Validator::make($input,[			
				'name' => 'required|max:100',
				'text' => 'required|max:150',
				'icon' => 'required|max:15',			
			], $massages);

			
			if($validator->fails()) {
				return redirect()->route('servicesAdd')->withErrors($validator)->withInput();
			}		
			
			
			$service = Service::create($input);
			
			if($service) {
				return redirect('admin')->with('status','Сервис добавлен');
			}
			
		}
		
		$optionList = [
			'Android' => 'fa-android',
			'Apple IOS' => 'fa-apple',
			'Design' => 'fa-dropbox',
			'Concept' => 'fa-html5',
			'User Research' => 'fa-slack',
			'User Experience' => 'fa-users',
			'User University' => 'fa-university',
		];
		if(view()->exists('admin.services_add')) {
			
			$data = [
					
					'title' => 'Новый сервис',
					'optionList' => $optionList,					
					];
			return view('admin.services_add',$data);		
			
		}
		
		abort(404);
		
		
	}
}