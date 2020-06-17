<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\I18n\Time;

class AuthModel{
  protected $db;

  public function __construct(ConnectionInterface &$db){
    $this->db =& $db;
  }

  function checkLogin()
  {
    //sol
    $salt = 'as3d)(d@#$DYUf@*&^2%DU$381#@!';
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $password .= $salt;

    //$pass = password_hash($password, PASSWORD_DEFAULT);

    $query = $this->db->table('users')
                     ->select('password')
                     ->where('email', $email)
                     ->limit(1)
                     ->get()
                     ->getResult();

    foreach($query as $key){
      $hash = $key->password;
    }
    if(isset($hash)){
        if(password_verify($password, $hash)){
          $loged_at = new Time('now');
          $query = $this->db->table('users')
                            ->set('last_logged', $loged_at)
                            ->where('email', $email)
                            ->update();
          return true;
        }else{
          return false;
        }
    }else{
      return false;
    }
  }

  function getUserData($email){
      return $this->db->table('users')
                      ->where('email =', $email)
                      ->join('user_data', 'users.user_id = user_data.user_id')
                      ->limit(1)
                      ->get()
                      ->getRow();
  }


}
