<?php
include_once("Entidades/Token.php");
include_once("Entidades/Empleado.php");
class EmpleadoApi extends Empleado
{  


    ///Registro de nuevos empleados.
    public function RegistrarEmpleado($request, $response, $args)
    {
        echo('EMPLEADOAPI');
        $parametros = $request->getParsedBody();
        $usuario = $parametros["usuario"];
        $clave = $parametros["clave"];
        $nombre = $parametros["nombre"];
        $tipo = $parametros["tipo"];


        $respuesta = Empleado::Registrar($usuario, $clave, $nombre, $tipo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
    ?>