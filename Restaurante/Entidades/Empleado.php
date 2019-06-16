<?php
include_once("DB/AccesoDatos.php");

class Empleado
{

    public $id;
    public $tipo;
    public $cantidad_operaciones;
    public $nombre;
    public $usuario;
    public $estado;
    public $fechaRegistro;
    public $ultimoLogin;


    public static function Registrar($usuario, $clave, $nombre, $tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $respuesta = "";
        try {
            echo ('EMPLEADO.PHP');
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $fecha = date('Y-m-d H:i:s');

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT ID_tipo_empleado FROM tipoempleado WHERE descripcion = :tipo AND estado = 'A';");

            $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $consulta->execute();
            $id_tipo = $consulta->fetch();

            if ($id_tipo != null) {
                $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO empleados (ID_tipo_empleado, nombre_empleado, usuario, 
                clave, fecha_registro, estado) 
                VALUES (:id_tipo, :nombre, :usuario, :clave, :fecha, 'A');");

                $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
                $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
                $consulta->bindValue(':id_tipo', $id_tipo[0], PDO::PARAM_INT);

                $consulta->execute();

                $respuesta = array("Estado" => "OK", "Mensaje" => "Empleado registrado correctamente.");
            } else {
                $respuesta = array("Estado" => "ERROR", "Mensaje" => "Debe ingresar un tipo de empleado valido");
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $respuesta;
        }
    }

    public static function Login($user, $password)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT te.descripcion as tipo_empleado, em.ID_Empleado, nombre_empleado FROM empleados em
                                                            INNER JOIN tipoempleado te  on em.ID_tipo_empleado = te.ID_tipo_empleado 
                                                            WHERE em.usuario = :user AND em.clave = :password AND em.estado = 'A'");

        $consulta->execute(array(":user" => $user, ":password" => $password));

        $resultado = $consulta->fetch();
        return $resultado;
    }
    ///Actualiza la ultima fecha de logueo de los empleados.
    public static function ActualizarFechaLogin($id_empleado)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date('Y-m-d H:i:s');

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados SET fecha_ultimo_login = :fecha WHERE ID_empleado = :id");

        $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
        $consulta->bindValue(':id', $id_empleado, PDO::PARAM_INT);

        $consulta->execute();
    }

    ///Baja de empleados.
    public static function Baja($id_empleado)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados SET estado = 'B' WHERE ID_Empleado = :id");

            $consulta->bindValue(':id', $id_empleado, PDO::PARAM_INT);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Empleado dado de baja correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $respuesta;
        }
    }

    public static function Suspender($id_empleado)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados SET estado = 'S' WHERE ID_empleado = :id");

            $consulta->bindValue(':id', $id_empleado, PDO::PARAM_INT);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Empleado suspendido correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $respuesta;
        }
    }

    public static function Modificar($id_empleado, $usuario, $nombre, $tipo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT ID_tipo_empleado FROM tipoempleado WHERE descripcion = :tipo AND estado = 'A';");

            $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $consulta->execute();
            $id_tipo = $consulta->fetch();

            if ($id_tipo != null) {
                $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados set ID_tipo_empleado = :id_tipo, nombre_empleado = :nombre, usuario = :usuario
                                                                WHERE id_empleado = :id_empleado");

                $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                $consulta->bindValue(':id_empleado', $id_empleado, PDO::PARAM_INT);
                $consulta->bindValue(':id_tipo', $id_tipo[0], PDO::PARAM_INT);

                $consulta->execute();

                $respuesta = array("Estado" => "OK", "Mensaje" => "Empleado modificado correctamente.");
            } else {
                $respuesta = array("Estado" => "ERROR", "Mensaje" => "Debe ingresar un tipo de empleado valido");
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $respuesta;
        }
    }

      ///Listado completo de empleados
      public static function Listar()
      {
          try {
              $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
  
              $consulta = $objetoAccesoDato->RetornarConsulta("SELECT em.ID_empleado as id, te.Descripcion as tipo, em.nombre_empleado as nombre, 
                                                          em.usuario, em.fecha_registro as fechaRegistro, em.fecha_ultimo_login as ultimoLogin, em.estado,
                                                          em.cantidad_operaciones 
                                                          FROM empleados em INNER JOIN tipoempleado te on em.id_tipo_empleado = te.id_tipo_empleado");
  
              $consulta->execute();
  
              $respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");
          } catch (Exception $e) {
              $mensaje = $e->getMessage();
              $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
          }
          finally {
              return $respuesta;
          }
      }

        ///Sumar 1 operacion al empleado
    public static function SumarOperacion($id_empleado)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleados 
                                                            SET cantidad_operaciones = cantidad_operaciones + 1
                                                            WHERE id_empleado = :id_empleado");

            $consulta->bindValue(':id_empleado', $id_empleado, PDO::PARAM_INT);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Operación sumada correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }
}
?>
