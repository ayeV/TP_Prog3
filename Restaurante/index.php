<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once './API/EmpleadoAPI.php';
include_once './Middleware/EmpleadoMW.php';
include_once './Middleware/OperacionMW.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);




$app->group('/empleados', function () {
 //post
$this->post('/login[/]', \EmpleadoAPI::class . ':LoginEmpleado');  
$this->post('/registrarEmpleado[/]', \EmpleadoAPI::class . ':RegistrarEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');   

//get
$this->get('/listar[/]', \EmpleadoAPI::class . ':ListarEmpleados')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 




       
});

$app->run();
?>
