<?php
namespace App\Controllers;
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
abstract class BaseController{
  protected $view;

  function __construct(){
    $this->view = new Environment(new FilesystemLoader('../resources/views'));
  }
}
