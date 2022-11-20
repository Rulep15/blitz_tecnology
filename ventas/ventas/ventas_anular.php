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
                                <h3 class="box-title">Anular Venta</h3>
                                <div class="box-tools">
                                    <a href="ventas_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="ventas_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_ventas WHERE id_venta =" . $_GET['vidventa']); ?>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="voperacion" value="3">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Codigo de Venta</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vidventa" readonly="" value="<?php echo $resultado[0]['id_venta']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Usuario</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" />
                                                <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <?php $cliente = consultas::get_datos("SELECT * FROM ref_cliente WHERE id_cliente=" . $resultado[0]['id_cliente']); ?>
                                            <label class="col-lg-2 control-label">Cliente</label>
                                            <div class="col-lg-8">
                                                <input type="hidden" name="vidcliente" value="<?php echo $cliente[0]['id_cliente']; ?>">

                                                <input class="form-control" type="text" name="vnombre" readonly="" value="<?php echo $cliente[0]['nombres']; ?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">Numero de Factura</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vnrofactura" readonly="" value="<?php echo $resultado[0]['nro_factura']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Fecha</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo $resultado[0]['fechav']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Condicion</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vcondicion" readonly="" value="<?php echo $resultado[0]['condicion']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Cantidad de cuotas</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vcanticuo" readonly="" value="<?php echo $resultado[0]['cant_cuo']; ?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">Intervalo</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vintervalo" readonly="" value="<?php echo $resultado[0]['intervalo']; ?>">
                                            </div>
                                        </div>
                                       
                                       

                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <button class="btn btn-danger" type="submit">Anular</button>
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