<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once './API/EmpleadoAPI.php';
include_once './API/MesaAPI.php';
include_once './API/MenuAPI.php';
include_once './API/PedidoAPI.php';
include_once './API/EncuestaAPI.php';
include_once './API/FacturaAPI.php';

include_once './Middleware/EmpleadoMW.php';
include_once './Middleware/OperacionMW.php';
include_once './Middleware/PedidoMW.php';
include_once './Middleware/EncuestaMW.php';

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

//delete
$this->delete('/{usuario}[/]', \EmpleadoAPI::class . ':BajaEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->delete('/suspender/{usuario}[/]', \EmpleadoAPI::class . ':SuspenderEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->post('/modificar[/]', \EmpleadoAPI::class . ':ModificarEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
 
$this->post('/cambiarClave[/]', \EmpleadoAPI::class . ':CambiarClaveEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->get('/cantidadOperacionesPorSector[/]', \EmpleadoAPI::class . ':ObtenerCantidadOperacionesPorSector')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->post('/cantidadOperacionesEmpleadosPorSector[/]', \EmpleadoAPI::class . ':ObtenerCantidadOperacionesEmpleadosPorSector')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->post('/listarEntreFechasLogin[/]', \EmpleadoAPI::class . ':ListarEmpleadosEntreFechasLogin')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->post('/listarEntreFechasRegistro[/]', \EmpleadoAPI::class . ':ListarEmpleadosEntreFechasRegistro')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

       
});

$app->group('/mesas', function () {
    $this->post('/registrar[/]', \MesaAPI::class . ':RegistrarMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    
    
    $this->get('/listar[/]', \MesaAPI::class . ':ListarMesas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  

    $this->delete('/{codigo}[/]', \MesaAPI::class . ':BajaMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->post('/foto[/]', \MesaAPI::class . ':ActualizarFotoMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/estadoEsperando/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_EsperandoPedido')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken');

    $this->get('/mesas/estadoComiendo/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Comiendo')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/estadoPagando/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Pagando')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/estadoCerrada/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Cerrada')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/cobrar/{codigo}[/]', \MesaAPI::class . ':CobrarMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/MasUsada[/]', \MesaAPI::class . ':MesaMasUsada')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/MenosUsada[/]', \MesaAPI::class . ':MesaMenosUsada')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/MasFacturacion[/]', \MesaAPI::class . ':MesaMasFacturacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/MenosFacturacion[/]', \MesaAPI::class . ':MesaMenosFacturacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/ConFacturaConMasImporte[/]', \MesaAPI::class . ':MesaConFacturaConMasImporte')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/ConFacturaConMenosImporte[/]', \MesaAPI::class . ':MesaConFacturaConMenosImporte')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/ConMejorPuntuacion[/]', \MesaAPI::class . ':MesaConMejorPuntuacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->get('/ConPeorPuntuacion[/]', \MesaAPI::class . ':MesaConPeorPuntuacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->post('/FacturacionEntreFechas[/]', \MesaAPI::class . ':MesaFacturacionEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 



});


$app->group('/menu', function () {

    $this->post('/registrar[/]', \MenuAPI::class . ':RegistrarComida')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  
    $this->post('/modificar[/]', \MenuAPI::class . ':ModificarComida')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    $this->get('/listar[/]', \MenuAPI::class . ':ListarMenu')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');   
    $this->delete('/{id}[/]', \MenuAPI::class . ':BajaMenu')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    


});

$app->group('/pedido', function () {

    //Pedido
$this->post('/registrar[/]', \PedidoAPI::class . ':RegistrarPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->delete('/{codigo}[/]', \PedidoAPI::class . ':CancelarPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->get('/listarTodos[/]', \PedidoAPI::class . ':ListarTodosLosPedidos')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->get('/listarCancelados[/]', \PedidoAPI::class . ':ListarTodosLosPedidosCancelados')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');

$this->post('/listarTodosPorFecha[/]', \PedidoAPI::class . ':ListarTodosLosPedidosPorFecha')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  

$this->get('/listarPorMesa/{codigoMesa}[/]', \PedidoAPI::class . ':ListarTodosLosPedidosPorMesa');
$this->get('/listarActivos[/]', \PedidoAPI::class . ':ListarPedidosActivos')
->add(\EmpleadoMW::class . ':ValidarToken');  

$this->post('/tomarPedido[/]', \PedidoAPI::class . ':TomarPedidoPendiente')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarTomarPedido')
->add(\EmpleadoMW::class . ':ValidarToken');  

$this->post('/listoParaServir[/]', \PedidoAPI::class . ':InformarPedidoListoParaServir')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarInformarListoParaServir')
->add(\EmpleadoMW::class . ':ValidarToken');  

$this->post('/servir[/]', \PedidoAPI::class . ':ServirPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarServir')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->get('/tiempoRestante/{codigoPedido}[/]', \PedidoAPI::class . ':TiempoRestantePedido');
$this->get('/listarFueraDelTiempoEstipulado[/]', \PedidoAPI::class . ':ListarPedidosFueraDelTiempoEstipulado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 

$this->get('/MasVendido[/]', \PedidoAPI::class . ':LoMasVendido')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  

$this->get('/MenosVendido[/]', \PedidoAPI::class . ':LoMenosVendido')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  

});



$app->group('/encuesta', function () {
    $this->post('/registrar[/]', \EncuestaAPI::class . ':RegistrarEncuesta')
    ->add(\EncuestaMiddleware::class . ':ValidarEncuesta'); 

    $this->get('/listar[/]', \EncuestaAPI::class . ':ListarEncuestas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 

    $this->post('/listarEntreFechas[/]', \EncuestaAPI::class . ':ListarEncuestasEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
});


$app->group('/factura', function () {
    



    $this->get('/listarVentasPDF[/]', \FacturaAPI::class . ':ListarVentasPDF')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  

    $this->get('/listarVentasExcel[/]', \FacturaAPI::class . ':ListarVentasExcel')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  

    $this->post('/listarEntreFechas[/]', \FacturaAPI::class . ':ListarFacturasEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
});
$app->run();
