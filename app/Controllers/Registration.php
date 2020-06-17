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
				'username' => [
					'rules' => 'required|alpha|max_length[50]',
					'errors' => [
							'required' => 'Musisz podać nazwę użytkownika!',
							'alpha' => 'Nazwa użytkownika może składać się jedynie z liter (małe lub duże)',
							'max_length' => 'Nazwa użytkownika może zawierać maksymalnie 50 znaków'
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

				echo $model->checkLogin();

				 if($model->checkLogin()){
				 	return redirect()->to('login/success');
				 }else {
					 $data['blad_logowania'] = 'Błąd logowania. Błędny użytkownik lub hasło.';
				 	return view('Login', $data);
				 }

			}else {
				$data['validation'] = $this->validator;
			}

		}

			return view('Login', $data);
	}

	function success(){
		return 'Hey, you have passed the validation. Congratulations!';
	}

	//--------------------------------------------------------------------

}
