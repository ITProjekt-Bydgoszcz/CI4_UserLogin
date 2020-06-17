<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\I18n\Time;

class UsersModel{
  protected $db;

  public function __construct(ConnectionInterface &$db){
    $this->db =& $db;
  }

  function users($newAvatarName)
  {
    $salt = ')(*&^%$#@!';
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $password .= $salt;
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthday = $_POST['birthday'];
    $permission = $_POST['permission'];
    $avatar = $newAvatarName;

    $dataCreation = new Time('now');

    $query = $this->db->table('users')
                     ->set('email', $email)
                     ->set('password', $pass)
                     ->set('created_at', $dataCreation)
                     ->insert();
    $lastInsertId = $this->db->insertID();

   $query = $this->db->table('user_data')
                    ->set('user_id', $lastInsertId)
                    ->set('name', $name)
                    ->set('surname', $surname)
                    ->set('company_id', 1)
                    ->set('birthday', $birthday)
                    ->set('img', $avatar)
                    ->set('permission', $permission)
                    ->insert();

    if($query){
      return true;
    }else {
      return false;
    }

  }


  function updateUser($newAvatarName, $id)
  {
    $salt = 'as3d)(d@#$DYUf@*&^2%DU$381#@!';
    $email = $_POST['email'];

    if ($_POST['password']) {
      $password =  $_POST['password'];
      $password .= $salt;
      $pass = password_hash($password, PASSWORD_DEFAULT);
    }

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthday = $_POST['birthday'];
    $permission = $_POST['permission'];
    if ($newAvatarName != 'defaultUserAvatar.png') {
      $avatar = $newAvatarName;
    }


    $dataCreation = new Time('now');

    if ($_POST['password']) {
      $query = $this->db->table('users')
                       ->where('user_id', $id)
                       ->set('email', $email)
                       ->set('password', $pass)
                       ->update();
    }else{
      $query = $this->db->table('users')
                       ->where('user_id', $id)
                       ->set('email', $email)
                       ->update();
    }

    if ($newAvatarName != 'defaultUserAvatar.png') {
       $query = $this->db->table('user_data')
                        ->where('user_id', $id)
                        ->set('name', $name)
                        ->set('surname', $surname)
                        ->set('company_id', 1)
                        ->set('birthday', $birthday)
                        ->set('img', $avatar)
                        ->set('permission', $permission)
                        ->update();
    }else{
      $query = $this->db->table('user_data')
                       ->where('user_id', $id)
                       ->set('name', $name)
                       ->set('surname', $surname)
                       ->set('company_id', 1)
                       ->set('birthday', $birthday)
                       ->set('permission', $permission)
                       ->update();
    }

    if($query){
      return true;
    }else {
      return false;
    }

  }

  public function selectIntranetUsers(){
      $query = $this->db->table('users')
                        ->join('user_data', 'users.user_id = user_data.user_id')
                        ->get()
                        ->getResult();
      return  $query;
  }

  public function removeuser($id){

      //sprawdz czy usuwam administratora czy zwyklego defaultUserAvatar
      $getPermission = $this->db->table('user_data')
                                ->select('permission')
                                ->where('user_id', $id)
                                ->get()
                                ->getRow();
      if($getPermission == '1'){
      //policz ilu uzytkownikow z uprawnieniami administratora, w systemie musi być minimum 1
      $countUser = $this->db->table('user_data')
                            ->where('permission', 1)
                            ->countAllResults();
        if($countUser > 1){
            $this->db->table('user_data')
                      ->where('user_id', $id)
                      ->delete();
            $delete = $this->db->table('users')
                      ->where('user_id', $id)
                      ->delete();
        }else{
            return false;
        }
      }else{
        $this->db->table('user_data')
                  ->where('user_id', $id)
                  ->delete();
        $delete = $this->db->table('users')
                  ->where('user_id', $id)
                  ->delete();

      }

      if($delete){
        return true;
      }else{
        return false;
      }

  }


  // protected $primaryKey = 'user_id';
  // protected $allowedFields = ['user', 'password'];
  //
  // protected $useTimestamps = true;
  // protected $updatedField = 'last_logged';
}
