<?php namespace App\Controllers;

use App\Models\MasterCompanyModel;

class GlobalSettings extends BaseController
{

	public function index()
	{
			$data = [];
			$model = new MasterCompanyModel();
			$companyData = $model->find(1);
			$data['company_data'] = [
					'company_name' => $companyData['name'],
				];
			return view('globalsettings', $data);
	}




	//--------------------------------------------------------------------

}
