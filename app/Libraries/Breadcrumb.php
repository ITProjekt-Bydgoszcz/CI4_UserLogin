<?php namespace App\Libraries;

use App\Controllers\BaseController;

class Breadcrumb extends BaseController{
  public function breadcrumb(){

     $uri_1 = $this->request->uri->getSegment(1);
     $uri_2 = $this->request->uri->getSegment(2);

    $segments = [
      'uri_1' => $uri_1,
      'uri_2' => $uri_2,
    ];
    return view('components/Breadcrumb', $segments);
  }
}
