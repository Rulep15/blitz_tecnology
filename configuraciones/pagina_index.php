<?php session_start(); ?>
<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../conexion.php';
        require '../estilos/css_lte.ctp';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div id="wrapper" style="background-color: #1E282C;">
            <?php require '../estilos/cabecera.ctp'; ?>
            <?php require '../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color:#333333;;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $mensaje = explode("_/_", $_SESSION['mensaje']);
                                if (($mensaje[0] == 'NOTICIA')) {
                                    $class = "success";
                                } else {
                                    $class = "danger";
                                }
                                ?>
                                <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                    <i class="ion ion-information-circled"></i>
                                    <?php
                                    echo $mensaje[1];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Paginas</h3>
                                    <div class="box-tools">
                                        <a href="pagina_add.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                       
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="proveedor_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por codigo de pagina...!" autofocus=""/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" 
                                                                            data-placement="bottom" rel="tooltip">
                                                                        <span class="fa fa-search"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--BUSCADOR-->
                                            <?php
                                            $valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }
                                            $proveedor = consultas::get_datos("SELECT * FROM ref_paginas WHERE (pag_cod||TRIM(UPPER(pag_direc))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY pag_cod");
                                            if (!empty($proveedor)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Direccion</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Modulo</th>
                                                                <th class="text-center"></th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($proveedor AS $pro) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pro['pag_cod']; ?></td>
                                                                    <td class="text-center"> <?php echo $pro['pag_direc']; ?></td>
                                                                    <td class="text-center"> <?php echo $pro['pag_nombre']; ?></td>
                                                                    <td class="text-center"> <?php echo $pro['mod_cod']; ?></td>
                                                                    <td class="text-center">
                                                                    </td>
                                                                    <td class="text-center">
                    
                                                                        <a href="pagina_delete.php?vprvcod=<?php echo $pro['pag_cod']; ?>" 
                                                                           class="btn btn-danger btn-sm" role="button"
                                                                           data-title="Borrar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alesrt alert-danger flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han encontrado registros...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require '../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../estilos/js_lte.ctp'; ?>
    <SCRIPT>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
    </SCRIPT>
</HTML>
