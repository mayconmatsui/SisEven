<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Configurations/app.php';
require __DIR__ .'/../App/Configurations/database.php';

$app = AppFactory::create();
  require __DIR__ .'/../App/Configurations/routes.php';
$app->run();
