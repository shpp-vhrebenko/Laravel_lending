<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
     public function execute() {		
		
		if(view()->exists('admin.portfolios')) {
			
			$portfolios = Portfolio::all();
			
			$data = [
					
					'title' => 'Портфолио',
					'portfolios' => $portfolios
					
					];
			
			return view('admin.portfolios',$data);		
			
		}
		
		abort(404);
	}
}
