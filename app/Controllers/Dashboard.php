<?php namespace App\Controllers;


//use App\Models\AuthModel;

class Dashboard extends BaseController
{
	public function index()
	{
			$data = [];
			return view('Dashboard', $data);
	}



	//--------------------------------------------------------------------

}
