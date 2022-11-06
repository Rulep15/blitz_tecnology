<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$persona = $_REQUEST['vidpersona'];
$ci = $_REQUEST['vci'];
$nombre = $_REQUEST['vnombre'];


$sql = "SELECT sp_ref_cliente(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",".
        (!empty($persona) ? $persona:0).",'".
        (!empty($ci) ? $ci:0)."','".
        (!empty($nombre) ? $nombre:0)."') AS cliente;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['cliente'] != NULL) {
    $valor = explode("*" , $resultado[0]['cliente']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:cliente_index.php");
}
