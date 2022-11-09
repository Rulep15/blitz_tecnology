<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpedido'];
$usuario = $_REQUEST['vusuario'];
$fecha = $_REQUEST['vfecha'];
$total = $_REQUEST['vtotal'];
$cliente = $_REQUEST['vidcliente'];
$estado = $_REQUEST['vestado'];



$sql = "SELECT sp_ventas_pedidos(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "'," .
    (!empty($total) ? $total : 0) . "," .
    (!empty($cliente) ? $cliente : 0) . ",'" .
    (!empty($estado) ? $estado : "VACIO") . "') AS pedidosv;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['pedidosv'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['pedidosv'];
    header("location:pedidosv_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosv_index.php");
}
