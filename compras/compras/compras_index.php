<?php session_start(); ?>
<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div id="wrapper" style="background-color:  #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #BBBBBB;"> 
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
                            <div class="box box-primary" >
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Compras</h3>
                                    <div class="box-tools">
                                        <a href="compras_add.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>

                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="compras_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por codigo o proveedor..." autofocus=""/>
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
                                            $compras = consultas::get_datos("SELECT * FROM v_compras WHERE (id_compra||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_compra");
                                            if (!empty($compras)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Nro Fact</th>
                                                                <th class="text-center">Condicion</th>
                                                                <th class="text-center">Iva Total</th>
                                                                <th class="text-center">Total Compra</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($compras AS $c) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $c['id_compra']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['fecha_compra1']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['nro_factura']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['condicion']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['ivatotal']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['totalc']; ?></td>

                                                                    <td class="text-center">
                                                                      
                                                                        <?php if ($c['estado'] == 'ACTIVO' || $c['estado'] == 'ANULADO' || $c['estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="compras_detalle.php?vidcompra=<?php echo $c['id_compra']; ?>" 
                                                                               class="btn btn-primary btn-sm" role="button"
                                                                               data-title="Detalle" rel="tooltip" data-placement="top">
                                                                                <i class="fa  fa-list"></i>

                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php
                                                                        if ($c['estado'] == 'ACTIVO') {
                                                                            $cdetalle = consultas::get_datos("SELECT * FROM compras_detalle WHERE id_compra=" . $c['id_compra']);
                                                                            if (!empty($cdetalle)) {
                                                                                ?>
                                                                                <!--?php if ($c['totalc'] > 0) { ?>-->
                                                                                    <a href="compras_confirmar.php?vidcompra=<?php echo $c['id_compra']; ?>" 
                                                                                       class="btn btn-success btn-sm" role="button"
                                                                                       data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                        <span id="confirmar" class="glyphicon glyphicon-ok-sign"></span>
                                                                                    </a>

                                                                                <!--?php } ?>-->
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <?php if ($c['estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="compras_anular.php?vidcompra=<?php echo $c['id_compra']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Anular" rel="tooltip" data-placement="top">
                                                                                <span  class="glyphicon glyphicon-ban-circle"></span>
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($c['estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="compras_print.php?vidcompra=<?php echo $c['id_compra']; ?>" 
                                                                               class="btn btn-success btn-sm" role="button"
                                                                               data-title="Impresion" rel="tooltip" data-placement="top">
                                                                                <span  class="fa fa-print"></span>
                                                                            </a>
                                                                        <?php } ?>

                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-danger flat">
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
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <SCRIPT>
        $("#mensaje").delay(2000).slideUp(200, function () {
            $(this).alert('close');
        });
    </SCRIPT>
</HTML>



