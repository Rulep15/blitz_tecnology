<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidventa'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];
$subtotal = $_REQUEST['vsubtotal'];


$sql = "SELECT sp_ventas_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($deposito) ? $deposito : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . "," .
    (!empty($precio) ? $precio : 0) . "," .
    (!empty($subtotal) ? $subtotal : 0) . ") AS ventasdetalles;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ventasdetalles'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['ventasdetalles'];
    header("location:ventas_detalle.php?vidventa=" . $_REQUEST['vidventa']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ventas_detalle.php?vidventa=" . $_REQUEST['vidventa']);
}
