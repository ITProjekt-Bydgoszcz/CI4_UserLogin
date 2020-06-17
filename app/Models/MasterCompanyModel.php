<?php namespace App\Models;

use CodeIgniter\Model;

class MasterCompanyModel extends model{
  protected $table = 'master_company';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'address', 'nip', 'regon', 'logo', 'www', 'email', 'inne'];

}
