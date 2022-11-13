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
            <div class="content-wrapper" style="background-color: #333333">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <!-- CODIGO DE MENSAJE -->
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
                            <!-- CODIGO DE MENSAJE -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Tipo de Persona</h3>
                                    <div class="box-tools">
                                        <a class="btn btn-primary pull-right btn-sm" role="button"
                                           data-toggle="modal" data-target="#registrar">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="tipopersona_print.php" class="btn btn-success btn-sm pull-right" target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <!--BUSCADOR-->
                                            <form action="tipopersona_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Buscar por codigo o tipo de persona..." autofocus=""/>
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
                                            $tipo_persona = consultas::get_datos("SELECT * FROM ref_tipo_persona WHERE (id_tipper||TRIM(UPPER(tp_descri))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_tipper");
                                            if (!empty($tipo_persona)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Tipo de Persona</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($tipo_persona AS $tipoimp) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $tipoimp['id_tipper']; ?></td>
                                                                    <td class="text-center"> <?php echo $tipoimp['tp_descri']; ?></td>
                                                                    <td class="text-center">
                                                                        <a onclick="editar(<?php echo "'" . $tipoimp['id_tipper'] . "_" . $tipoimp['tp_descri'] . "'"; ?>)" 
                                                                           class="btn btn-sm btn-warning" role="button" data-title="Editar" 
                                                                           data-placement="top" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                                        </a>
                                                                        <a onclick="borrar(<?php echo "'" . $tipoimp['id_tipper'] . "_" . $tipoimp['tp_descri'] . "'"; ?>)" 
                                                                           class="btn btn-sm btn-danger" role="button" data-title="Borrar" 
                                                                           data-placement="top" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
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
            <!-- MODAL DE REGISTRAR -->
            <div class="modal fade" id="registrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Registrar Tipo de Persona</strong></h4>
                        </div>
                        <form action="tipopersona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="1" type="hidden">
                            <input name="vidtipoper" value="0" type="hidden">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tipo</label>
                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                        <input maxlength="30" type="text" class="form-control" name="vtipopdescri" required="" autofocus="" onkeypress="return soloLetras(event);">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger"> Cerrar</button>
                                <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- MODAL DE REGISTRAR -->
            <!-- MODAL DE EDITAR -->
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                            <h4 class="modal-title"><strong>Editar Tipo de Persona</strong></h4>
                        </div>
                        <form action="tipopersona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="2" type="hidden">
                            <input name="vidtipoper" value="0" type="hidden" id="codigo">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tipo</label>
                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                        <input maxlength="30" type="text" class="form-control" name="vtipopdescri" required="" onkeypress="return soloLetras(event);" 
                                               id="descripcion">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="fa fa-remove btn btn-danger"> Cerrar</button>
                                <button type="submit" class="fa fa-save btn btn-success pull-right"> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- MODAL DE EDITAR -->
            <!-- MODAL DE BORRAR -->
            <div class="modal fade" id="borrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title custom_align" id="Heading">Atencion!!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" id="confirmacion"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok-sign"></span>Si
                            </a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span>No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL DE BORRAR -->

        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        /*MENSAJE*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        //PARA QUE EL FOCO SE VAYA EN EL INPUT
        $(".modal").on('shown.bs.modal', function () {
            $(this).find('input:text:visible:first').focus();
        });

        function editar(datos) {
            var dat = datos.split("_");
            $('#codigo').val(dat[0]);
            $('#descripcion').val(dat[1]);
        }
        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'tipopersona_control.php?vidtipoper=' + dat[0] + '&vtipopdescri=' + dat[1] + '&voperacion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea Borrar el registro <i><strong>' + dat[1] + '</strong></i>?');
        }
         //LETRAS
    function soloLetras(e)
    {
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

        if (letras.indexOf(tecla) == -1 && !tecla_especial)
        {
            //alert("Ingresar solo letras");
            return false;
        }
    }
    </script>
</HTML>
