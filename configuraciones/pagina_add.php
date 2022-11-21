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
                                <h3 class="box-title">Agregar Pagina</h3>
                                <div class="box-tools">
                                    <a href="proveedor_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="proveedor_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="row">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vcodigo" value="0" />
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Direccion</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="30" class="form-control" type="text" name="vdireccion" required="" placeholder="Ingresar Direccion">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nombre</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-7">
                                                <input maxlength="15" class="form-control" type="text" name="vnombre" required="" min="0">
                                            </div>
                                        </div>
                                        <!-- PERSONA -->
                                        <form action="pagina_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="voperacion" value="1">
                                                    <input type="hidden" name="vidcodigo" value="0">

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Modulo</label>
                                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                                            <div class="input-group">
                                                                <?php $empmpleado = consultas::get_datos("SELECT * FROM ref_modulo order by mod_cod"); ?>
                                                                <select class="form-control select3" name="vidmodulo" required="" style="width: 320px;">
                                                                    <?php
                                                                    if (!empty($empmpleado)) {
                                                                        foreach ($empmpleado as $emp) {
                                                                    ?>
                                                                            <option value="<?php echo $emp['mod_cod']; ?>"><?php echo $emp['per_nro_doc'] . ' - ' . $emp['mod_nombre'] . ' ' . $emp['per_apellido']; ?> </option>
                                                                        <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <option value="">Debe seleccionar al menos una marca</option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer" style="text-align: center;">
                                                <button class="fa fa-save btn btn-success pull-right" type="submit"> Guardar</button>
                                            </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--MODAL DE CIUDAD-->

        </div>
        <!--MODAL DE CIUDAD-->



    </div>
    </div>
    <?php require '../estilos/pie.ctp'; ?>
</BODY>
<?php require '../estilos/js_lte.ctp'; ?>
<script>
    /*MENSAJE DE INSERT ciudad, CARGO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    /*Focus en el primer input de ciudad*/
    $(document).ready(function() {
        $('#registrar_ciudad').on('shown.bs.modal', function() {
            $('#vpaisdescri, #vciudescri').focus();
        });
    });
    /*limpiar campos al cerrar nuestro modal persona*/
    $("#cerrar_ciudad").click(function() {
        $('#vpaisdescri, #vciudescri').val("");
    });
</script>
<script>
    //LETRAS
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

        especiales = [8, 13, 32];
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            //alert("Ingresar solo letras");
            return false;
        }
    }
</script>

</HTML>