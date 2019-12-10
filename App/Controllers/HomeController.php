<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class HomeController extends BaseController{
    public function index(Request $request,Response $response,$args){
      echo $this->view->render('admin/index.html');
      return $response;
    }
}