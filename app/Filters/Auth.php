<?php namespace App\Filters;

use Codeigniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface{
  public function before(RequestInterface $request){
    if(! session()->get('isLoggedIn'))
      return redirect()->to('/');
  }

  public function after(RequestInterface $request, ResponseInterface $response){

  }
}
