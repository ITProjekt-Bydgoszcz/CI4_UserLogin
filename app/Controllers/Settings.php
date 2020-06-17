<?php namespace App\Controllers;


use App\Models\MasterCompanyModel;
use App\Models\UsersModel;

class Settings extends BaseController
{

	public function index()
	{
			$data = [];
			$db = db_connect();
			$listUsers = new UsersModel($db);
			$data['listUsers'] = $listUsers->selectIntranetUsers();
			return view('Settings', $data);
	}


	public function users(){
		$model = new MasterCompanyModel();
		$companyData = $model->find(1);

		$db = db_connect();
		$listUsers = new UsersModel($db);
		$data['listUsers'] = $listUsers->selectIntranetUsers();


		$data['company_data'] = [
				'company_name' => $companyData['name'],
			];
			helper(['form']);
		return view('usersSettings', $data);
	}



	public function editUser(){
		$model = new MasterCompanyModel();
		$companyData = $model->find(1);
		$data['company_data'] = [
				'company_name' => $companyData['name'],
			];
		$db = db_connect();
		$listUsers = new UsersModel($db);
		$data['listUsers'] = $listUsers->selectIntranetUsers();

		helper(['form']);

		if($this->request->getMethod() == 'post'){
			if($this->request->getVar('password')){

			$rules = [
					'password' => [
						'rules' => 'required|min_length[8]|max_length[50]',
						'errors' => [
								'min_length' => 'Hasło musi składać się minimum z 8 znaków',
								'max_length' => 'Hasło może składać się maksymalnie z 50 znaków'
						]
					],
					'password2' => [
						'rules' => 'matches[password]',
						'errors' => [
								'matches' => 'Wpisane hasła nie pasują do siebie'
						]
					],
					'name' => [
						'rules' => 'required|min_length[3]|max_length[50]',
						'errors' => [
								'required' => 'Proszę podać imię',
								'min_length' => 'Imię musi składać się conajmniej z 3 znaków',
								'max_length' => 'Imię może składać się maksymalnie z 50 znaków',
						]
					],

					'surname' => [
						'rules' => 'required|min_length[2]|max_length[50]|alpha',
						'errors' => [
								'required' => 'Proszę podać nazwisko',
								'min_length' => 'Nazwisko musi składać się conajmniej z 2 znaków',
								'max_length' => 'Nazwisko może składać się maksymalnie z 50 znaków',
								'alpha' => 'Nazwisko może składać się jedynie z liter'
						]
					],
					'birthday' => [
						'rules' => 'required',
						'errors' => [
								'required' => 'Proszę podać datę urodzenia'
						]
					],

					'permission' => [
						'rules' => 'required',
						'errors' => [
								'required' => 'Proszę wybrać uprawnienia dla tworzonego użytkownika'
						]
					],
					'avatar' => [
						'rules' => 'max_size[avatar, 200]|is_image[avatar]|ext_in[avatar,png,jpg,jpeg,gif,svg]',
						'errors' => [
							'max_size' => 'Wielkość obrazka nie może przekroczyć 200 KB',
							'is_image' => 'Można użyć tylko obrazka',
							'ext_in' => 'Możliwe rozszerzenia plików to png, jpg, gif, svg'
						]
					]
			];
			}else{
			$rules = [
					'name' => [
						'rules' => 'required|min_length[3]|max_length[50]',
						'errors' => [
								'required' => 'Proszę podać imię',
								'min_length' => 'Imię musi składać się conajmniej z 3 znaków',
								'max_length' => 'Imię może składać się maksymalnie z 50 znaków',
						]
					],

					'surname' => [
						'rules' => 'required|min_length[2]|max_length[50]|alpha',
						'errors' => [
								'required' => 'Proszę podać nazwisko',
								'min_length' => 'Nazwisko musi składać się conajmniej z 2 znaków',
								'max_length' => 'Nazwisko może składać się maxymalnie z 50 znaków',
								'alpha' => 'Nazwisko może składać się jedynie z liter'
						]
					],
					'birthday' => [
						'rules' => 'required',
						'errors' => [
								'required' => 'Proszę podać datę urodzenia'
						]
					],

					'permission' => [
						'rules' => 'required',
						'errors' => [
								'required' => 'Proszę wybrać uprawnienia dla tworzonego użytkownika'
						]
					],
					'avatar' => [
						'rules' => 'max_size[avatar, 200]|is_image[avatar]|ext_in[avatar,png,jpg,jpeg,gif,svg]',
						'errors' => [
							'max_size' => 'Wielkość obrazka nie może przekroczyć 200 KB',
							'is_image' => 'Można użyć tylko obrazka',
							'ext_in' => 'Możliwe rozszerzenia plików to png, jpg, gif, svg'
						]
					]
			];

			}

			if($this->validate($rules)){

					$newAvatarName = 'defaultUserAvatar.png';
					$file = $this->request->getFile('avatar');
					if($file->isValid() && !$file->hasMoved()){
						$file->move('/home/intranet/images/avatar', $file->getRandomName());
						$newAvatarName = $file->getName();
					}


				 	$db = db_connect();
					$updateUser = new UsersModel($db);
					$check = $updateUser->updateUser($newAvatarName, $this->request->getVar('user_id')); //session()->user_id);

					if($check){
						session()->setFlashdata('success', 'Dane zostały prawidłowo zaktualizowane. Proszę się przelogować, w celu wprowadzenia zmian. <a href="/Login/logOut">Wyloguj teraz</a>');
						return redirect()->to('/settings/users');
						// $data['success'] = 'Dane zostały prawidłowo zaktualizowane. Proszę się przelogować, w celu wprowadzenia zmian. <a href="/Login/logOut">Wyloguj teraz</a>';
						// return view('usersSettings', $data);
					}else {
						session()->setFlashdata('error', 'Wystąpił błąd dane nie zostały zapisane!');
						return redirect()->to('/settings/users');
						// $data['blad'] = 'Wystąpił błąd dane nie zostały zapisane!';
						// return view('usersSettings', $data);
					}
			}else{
				$data['validation'] = $this->validator;
			}

		}



			return view('usersSettings', $data);
	}





	public function addUser(){
		$model = new MasterCompanyModel();
		$companyData = $model->find(1);
		$data['company_data'] = [
				'company_name' => $companyData['name'],
			];

		$db = db_connect();
		$listUsers = new UsersModel($db);
		$data['listUsers'] = $listUsers->selectIntranetUsers();

		helper(['form']);

		if($this->request->getMethod() == 'post'){

				$rules = [
						'email' => [
								'rules' => 'required|valid_email|max_length[50]|is_unique[users.email]',
								'errors' => [
										'required' => 'Adres email jest wymagany',
										'valid_email' => 'Prosze wprowadzić poprawny adres email',
										'max_length' => 'Maxymalna długość adresu email to 50',
										'is_unique' => 'Taki adres email istnieje już w bazie danych, proszę wybrać inny',
								]
						],
						'password' => [
							'rules' => 'required|min_length[8]|max_length[50]',
							'errors' => [
									'required' => 'Musisz podać hasło',
									'min_length' => 'Hasło musi składać się minimum z 8 znaków',
									'max_length' => 'Hasło może składać się maksymalnie z 50 znaków'
							]
						],
						'password2' => [
							'rules' => 'matches[password]',
							'errors' => [
									'matches' => 'Wpisane hasła nie pasują do siebie'
							]
						],
						'name' => [
							'rules' => 'required|min_length[3]|max_length[50]',
							'errors' => [
									'required' => 'Proszę podać imię',
									'min_length' => 'Imię musi składać się conajmniej z 3 znaków',
									'max_length' => 'Imię może składać się maksymalnie z 50 znaków',
							]
						],

						'surname' => [
							'rules' => 'required|min_length[2]|max_length[50]|alpha',
							'errors' => [
									'required' => 'Proszę podać nazwisko',
									'min_length' => 'Nazwisko musi składać się conajmniej z 2 znaków',
									'max_length' => 'Nazwisko może składać się maksymalnie z 50 znaków',
									'alpha' => 'Nazwisko może składać się jedynie z liter'
							]
						],
						'birthday' => [
							'rules' => 'required',
							'errors' => [
									'required' => 'Proszę podać datę urodzenia'
							]
						],

						'permission' => [
							'rules' => 'required',
							'errors' => [
									'required' => 'Proszę wybrać uprawnienia dla tworzonego użytkownika'
							]
						],
						'avatar' => [
							'rules' => 'max_size[avatar, 200]|is_image[avatar]|ext_in[avatar,png,jpg,jpeg,gif,svg]',
							'errors' => [
								'max_size' => 'Wielkość obrazka nie może przekroczyć 200 KB',
								'is_image' => 'Można użyć tylko obrazka',
								'ext_in' => 'Możliwe rozszerzenia plików to png, jpg, gif, svg'
							]
						]
				];


			if($this->validate($rules)){

					$newAvatarName = 'defaultUserAvatar.png';
					$file = $this->request->getFile('avatar');
					if($file->isValid() && !$file->hasMoved()){
						$file->move('/home/intranet/images/avatar', $file->getRandomName());
						$newAvatarName = $file->getName();
					}


					$db = db_connect();
					$saveNewUser = new UsersModel($db);
					$check = $saveNewUser->users($newAvatarName);

					if($check){
						// $data['success'] = 'Dane zostały prawidłowo zaktualizowane. Proszę się przelogować, w celu wprowadzenia zmian. <a href="/Login/logOut">Wyloguj teraz</a> ';
						// return view('usersSettings', $data);
						session()->setFlashdata('success', 'Nowy użytkownik został dodany prawidłowo.');
						return redirect()->to('/settings/users');
					}else {
						session()->setFlashdata('error', 'Wystąpił błąd dane nie zostały zapisane!');
						return redirect()->to('/settings/users');
						// $data['blad'] = 'Wystąpił błąd dane nie zostały zapisane!';
						// return view('usersSettings', $data);
					}

			}else{
				$data['validation'] = $this->validator;
			}

		}



			return view('usersSettings', $data);
	}

	public function removeUser($id){
		$model = new MasterCompanyModel();
		$companyData = $model->find(1);
		$data['company_data'] = [
				'company_name' => $companyData['name'],
			];
		helper(['form']);

		if(isset($id)){
			if(session()->permission == '1'){
				//jesli wszystko jest ok to usun usera
				$db = db_connect();
				$modelRemoveUser = new UsersModel($db);
				$removeUser = $modelRemoveUser->removeUser($id);
				if($removeUser){
					session()->setFlashdata('success', 'Użytkownik usunięty prawidłowo.');
				 	return redirect()->to('/settings/users');
				}else {
					session()->setFlashdata('error', 'Wystąpił błąd nie można usunąć użytkownika. Być może jest to jedyny administrator? W systemie musi być conajmniej jeden użytkownik z prawami administratora.');
				 	return redirect()->to('/settings/users');
				}
			}else{
					//jesli nie masz uprawnien do usuwania uzytkownikow
					session()->setFlashdata('error', 'Nie masz uprawnień do usuwania użytkowników.');
				 	return redirect()->to('/settings/users');
			}
		}else{
			//nie przeslano id usuwanego uzytkownikam, blad
				session()->setFlashdata('error', 'Wystąpił błąd nie mogę usunąć wybranego użytkownika.');
			 	return redirect()->to('/settings/users');
		}
			$db = db_connect();
			$listUsers = new UsersModel($db);
			$data['listUsers'] = $listUsers->selectIntranetUsers();


			//return view('usersSettings', $data);
	}



	//--------------------------------------------------------------------

}
