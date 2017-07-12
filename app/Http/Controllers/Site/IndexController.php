<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\People;
use DB;
use Mail;
use Session;

class IndexController extends Controller
{
    public function execute(Request $request) {
        if($request->isMethod('post')) {

            $messages = [
            
            'required' => "Поле :attribute обязательно к заполнению",
            'email' => "Поле :attribute должно соответствовать email адресу"
            
            ];
            
            $this->validate($request,[
            
            'name' => 'required|max:255',
            'email' => 'required|email',
            'text' => 'required'    
                    
            ], $messages);
            
            
            $data = $request->all();
            
            $result = Mail::send('site.email',['data'=>$data], function($message) use ($data) {
                
                $mail_admin = env('MAIL_ADMIN');
                
                $message->from($data['email'],$data['name']);
                $message->to($mail_admin,'Mr. Admin')->subject('Question');
                
                
            });                
                Session::flash('status', 'Email is send!');
            if($result) {                 
                return redirect()->route('home');
              /* return redirect('index')->with('status','Email is send!');*/
            }           
        }

    	$pages = Page::all();    	
    	$portfolios = Portfolio::all();    	
    	$services = Service::all();    	
    	$peoples = People::all(); 
    	$tags = DB::table('portfolios')->distinct()->pluck('filter');    	

    	$menu = array();	
    	foreach($pages as $page) {
    		$item = array('title' => $page->name,'alias' => $page->alias);
    		array_push($menu, $item);
    	}
    	$item = array('title' => 'Services', 'alias' => 'service');
    	array_push($menu, $item);
    	$item = array('title' => 'Portfolio', 'alias' => 'portfolio');
    	array_push($menu, $item);
    	$item = array('title' => 'Team', 'alias' => 'team');
    	array_push($menu, $item);
    	$item = array('title' => 'Contact', 'alias' => 'contact');
    	array_push($menu, $item);    	
    	return view('site.index', compact([
    											'menu',
    											'pages',
    											'portfolios',
    											'services',
    											'peoples',
    											'tags'
    										]));
    }   
}
