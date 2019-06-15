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

    public function LoginEmpleado($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $usuario = $parametros["usuario"];
        $clave = $parametros["clave"];
        $retorno = Empleado::Login($usuario, $clave);

        if ($retorno["tipo_empleado"] != "") {
            $token = Token::CodificarToken($usuario, $retorno["tipo_empleado"], $retorno["ID_Empleado"], $retorno["nombre_empleado"]);
            Empleado::ActualizarFechaLogin($retorno["ID_Empleado"]);
            $respuesta = array("Estado" => "OK", "Mensaje" => "Logueado exitosamente.", "Token" => $token, "Nombre_Empleado" => $retorno["nombre_empleado"]);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.");
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }   
}
    ?>