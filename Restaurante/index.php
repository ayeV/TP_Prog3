<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once './API/EmpleadoAPI.php';


$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->post('/empleados/login[/]', \EmpleadoAPI::class . ':LoginEmpleado');  
$app->post('/empleados/registrarEmpleado[/]', \EmpleadoAPI::class . ':RegistrarEmpleado');


$app->run();
?>
