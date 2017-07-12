<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Service;

use Validator;

class ServiceEditController extends Controller
{
    //
    
    public function execute(Service $service,Request $request) {
    	

    	if($request->isMethod('delete')) {    		
			$page->delete();
			return redirect('admin')->with('status','Сервис удален');
		}
		
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
				return redirect()
						->route('servicesEdit',['service'=>$input['id']])
						->withErrors($validator);
			}			
			
			
			if($service->update($input)) {
				return redirect('admin')->with('status','Сервис обновлен');
			}
			
		}

		/*$page = Page::find($id);*/		
		$old = $service->toArray();
		$optionList = [
			'Android' => 'fa-android',
			'Apple IOS' => 'fa-apple',
			'Design' => 'fa-dropbox',
			'Concept' => 'fa-html5',
			'User Research' => 'fa-slack',
			'User Experience' => 'fa-users',
			'User University' => 'fa-university',
		];

		if(view()->exists('admin.services_edit')) {			
			$data = [
					'title' => 'Редактирование сервиса - '.$old['name'],
					'data' => $old,
					'optionList' => $optionList,
					];
			return view('admin.services_edit',$data);		
			
		}
		
	}
}
