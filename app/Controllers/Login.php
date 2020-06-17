<?php namespace App\Controllers;


use App\Models\AuthModel;

class Login extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Intranet ITProjekt Bydgoszcz',
			'intranet' => 'Intranet ITProjekt',
			'mini_intrnet' => 'Panel dla klientów firmy ITProjekt Bydgoszcz',
			'intro' => 'Proszę się zalogować',
			'zapamietaj' => 'Zapamietaj mnie',
			'zaloguj' => 'ZALOGUJ',
			'przypomnij_haslo' => 'Przypomnij hasło'
		];


		helper(['form']);
	
		if($this->request->getMethod() == 'post'){
			$rules = [
				'email' => [
					'rules' => 'required|valid_email|max_length[50]',
					'errors' => [
							'required' => 'Musisz podać adres email!',
							'valid_email' => 'Musisz podać poprawny adres email.',
							'max_length' => 'Email może zawierać maksymalnie 70 znaków'
					]
				],
				'password' => [
					'rules' => 'required|min_length[8]|max_length[50]',
					'errors' => [
							'required' => 'Musisz podać hasło',
							'min_length' => 'Proszę wprowadzić poprawne hasło',
							'max_length' => 'Proszę wprowadzić poprawne hasło',
					]
				]
			];

			if($this->validate($rules))
			{
				$db = db_connect();
				$model = new AuthModel($db);
				$model->checkLogin($_POST);

				//echo $model->checkLogin();

				 if($model->checkLogin()){

					 $this->setUserSession($this->request->getVar('email'));
				 	return redirect()->to('dashboard/');
				 }else {
					 $data['blad_logowania'] = 'Błąd logowania. Błędny adres email lub hasło.';
				 	return view('Login', $data);
				 }

			}else {
				$data['validation'] = $this->validator;
			}

		}

			return view('Login', $data);
	}

	function setUserSession($email){
		$db = db_connect();
		$createDataSession = new AuthModel($db);
		$result = $createDataSession->getUserData($email);

		$data = [
			'user_id' => $result->user_id,
			'email' => $result->email,
			'name' => $result->name,
			'surname' => $result->surname,
			'company_id' => $result->company_id,
		  'birthday' => $result->birthday,
			'img' => $result->img,
			'permission' => $result->permission,
			'created_at' => $result->created_at,
			'last_logged' => $result->last_logged,
			'isLoggedIn' => true,
		];
		$session = \Config\Services::session();

		$session->set($data);
		return true;
	}

	public function logOut(){
		session()->destroy();
		return redirect()->to('/');
	}
	//--------------------------------------------------------------------

}
