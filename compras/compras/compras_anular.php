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
    <div class="wrapper" style="background-color: #1E282C;">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #333333;">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-edit"></i>
                                <h3 class="box-title">Anular Compra</h3>
                                <div class="box-tools">
                                    <a href="compras_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra =" . $_GET['vidcompra']); ?>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="voperacion" value="3">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Codigo de Compra</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vidcompra" readonly="" value="<?php echo $resultado[0]['id_compra']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Fecha</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo $resultado[0]['fechac']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php $proveedor = consultas::get_datos("SELECT * FROM ref_proveedor WHERE prv_cod=" . $resultado[0]['prv_cod']); ?>
                                            <label class="col-lg-2 control-label">Proveedor</label>
                                            <div class="col-lg-8">
                                                <input type="hidden" name="vidproveedor" value="<?php echo $proveedor[0]['prv_cod']; ?>">

                                                <input class="form-control" type="text" name="vproveedor" readonly="" value="<?php echo $proveedor[0]['prv_razon_social']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Numero de Factura</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vnrofactura" readonly="" value="<?php echo $resultado[0]['nro_factura']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <button class="btn btn-success" type="submit">Anular</button>
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