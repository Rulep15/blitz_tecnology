<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidventa'];
$usuario = $_REQUEST['vusuario'];
$cliente = $_REQUEST['vidcliente'];
$nrofactura = $_REQUEST['vnrofactura'];
$fecha = $_REQUEST['vfecha'];
$condicion = $_REQUEST['vcondicion'];
$canticuo = $_REQUEST['vcanticuo'];
$intervalo = $_REQUEST['vintervalo'];

$iva = 0;
$total = 0;
$estado = "ACTIVO";



$sql = "SELECT sp_ventas(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . "," .
    (!empty($cliente) ? $cliente : 0) . ",'" .    
    (!empty($nrofactura) ? $nrofactura : "VACIO") . "','" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
    (!empty($condicion) ? $condicion : "VACIO") . "'," .
    (!empty($canticuo) ? $canticuo : 0) . "," .
    (!empty($intervalo) ? $intervalo : 0) . "," .
    (!empty($iva) ? $iva : 0) . "," .
    (!empty($total) ? $total : 0) . ",'" .
    (!empty($estado) ? $estado : "VACIO") . "') AS ventas;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ventas'] != NULL) {
    $valor = explode("*", $resultado[0]['ventas']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ventas_index.php");
}
