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
    <div id="wrapper" style="background-color: #1E282C">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #333333;">
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
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title">Agregar Ventas</h3>
                                <div class="box-tools">
                                    <a href="ventas_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="ventas_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="row">
                                        <input type="hidden" name="voperacion" value="1">

                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Codigo de Venta</label>
                                            <?php $ventas = consultas::get_datos("SELECT COALESCE(MAX(id_venta),0)+1 AS ultimo FROM ventas") ?>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="text" name="vidventa" readonly="" value="<?php echo $ventas[0]['ultimo']; ?>">
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
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Cliente</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <?php $cli = consultas::get_datos("SELECT * FROM ref_cliente ORDER BY id_cliente"); ?>
                                                    <select class="select2" name="vidcliente" required="" style="width: 320px;">
                                                        <?php
                                                        if (!empty($cli)) {
                                                            foreach ($cli as $pv) {
                                                        ?>
                                                                <option value="<?php echo $pv['id_cliente']; ?>"> <?php echo $pv['nombres']; ?> </option>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un Cliente</option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#registrar_cliente">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nro Factura</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="text" name="vnrofactura" required="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Fecha</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Condicion</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <select name="vcondicion" class="form-control" id="vcondi" onchange="tiposelect()">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Cantidad Cuota</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="hidden" name="vcanticuo" value="1">

                                                <input class="form-control" type="number" name="vcanticuo" id="vcancuota" min="1" max="36" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Intervalo</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input class="form-control" type="hidden" name="vintervalo" value="15">
                                                <select name="vintervalo" class="form-control" id="vintervalo" onchange="">
                                                    <option value="15">15</option>
                                                    <option value="30">30</option>
                                                </select>
                                            </div>
                                        </div>


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
<script>
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close')
    });
</script>
<script>
    function tiposelect() {
        if (document.getElementById('vcondi').value === "CONTADO") {
            document.getElementById('vcancuota').setAttribute('disabled', 'true');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').setAttribute('disabled', 'true');
        } else {
            document.getElementById('vcancuota').removeAttribute('disabled');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').removeAttribute('disabled');

        }
    }
    window.onload = tiposelect();
</script>

</HTML>