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
        <div id="wrapper" style="background-color: #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #333333;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Pedido</h3>
                                    <div class="box-tools">
                                        <a href="pedidosv_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="pedidosv_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ventas_pedido WHERE id_pedido =" . $_GET['vidpedido']); ?>
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="operacion" value="2">
                                            <input class="form-control" name="vidpedido" type="hidden"value="<?php echo $resultado[0]['id_pedido']; ?>">
                                            <input class="form-control" name="vusuario" type="hidden"value="<?php echo $resultado[0]['usu_cod']; ?>">
                                            <input class="form-control" name="vfecha" type="hidden"value="<?php echo $resultado[0]['fechap']; ?>">
                                        <!--Cliente-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-2">Cliente</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="input-group">
                                                    <?php $cliente = consultas::get_datos("SELECT * FROM ref_cliente ORDER BY id_cliente"); ?>
                                                    <select class="select2" name="vidcliente" required="" style="width: 500px;">
                                                        <?php
                                                        if (!empty($cliente)) {
                                                            foreach ($cliente as $c) {
                                                        ?>
                                                                <option value="<?php echo $c['id_cliente']; ?>"><?php echo $c['nombres']; ?></option>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un cliente</option>
                                                        <?php }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                            <input class="form-control" name="vestado" type="hidden"value="<?php echo $resultado[0]['estado']; ?>">
                                           
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: right;">
                                        <button class="fa fa-save btn btn-success" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
</HTML>


