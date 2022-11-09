<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpedido'];
$deposito = $_REQUEST['vdeposito'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];


$sql = "SELECT sp_ventas_pedidos_detalle(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($deposito) ? $deposito : 0) . "," .
        (!empty($producto) ? $producto : 0) . "," .
        (!empty($cantidad) ? $cantidad : 0) . "," .
        (!empty($precio) ? $precio : 0) . ") AS dpedidosv;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['dpedidosv'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['dpedidosv'];
    header("location:pedidosv_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pedidosv_detalle.php?vidpedido=" . $_REQUEST['vidpedido']);
}
