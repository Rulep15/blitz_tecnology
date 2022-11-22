<?php
    require '../../conexion.php';
    session_start();
    
    $operacion = $_REQUEST['voperacion'];
    $codigo = $_REQUEST['vpagina'];
    $nombre = $_REQUEST['vnombre'];
    $direccion = $_REQUEST['vdireccion'];
    $modulo = $_REQUEST['vmodulo'];
    
    
    $sql = "SELECT sp_ref_pagina(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",'".
        (!empty($nombre) ? $nombre:"VACIO")."','".
        (!empty($direccion) ? $direccion:"VACIO")."',".
        (!empty($modulo) ? $modulo:0).") AS paginas;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['paginas'] != NULL) {
    $valor = explode("*" , $resultado[0]['paginas']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pagina_index.php");
}
?>
