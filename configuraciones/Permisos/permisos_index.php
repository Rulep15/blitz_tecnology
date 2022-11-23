<?php session_start() ?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #333333">
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
                                    <h3 class="box-title">Permisos</h3>
                                    <div class="box-tools">
                                        <a style="padding: 8px; margin: 1px" data-toggle="modal" data-target="#registrar"  
                                           onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vgrup'] . "_" . $_REQUEST['vgrunombre'] . "'" ?>);"
                                           class="btn btn-success pull-right btn-sm" rel="tooltip" title="Añadir">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/T.A/configuraciones/Usuario/usuario_index.php" class="btn btn-bitbucket pull-right btn-sm" rel="tooltip" title="Atras" style="padding: 8px; margin: 1px">
                                            <i class="fa fa-arrow-circle-left"></i>
                                        </a>
                                        <!--BUSCADOR-->
                                        <form action="permisos_index.php" method="POST" accept-charset="UTF-8" class="form-inline" >
                                            <div  style="float: right; width: 52%;display: block;">
                                                <div class="form-group-sm" >
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form ">
                                                                <input type="text" class="form-control" name="buscar" placeholder="Cod/user..." style="margin:auto">
                                                                <span class="glyphicon glyphicon-search form-control-feedback" ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--  BUSCADOR--> 
                                    </div>
                                </div>
                                <div class="box-body no-padding" >
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">

                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- registrar-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" id="detalles_registrar">

                        </div>
                    </div>
                </div>
                <!-- registrar-->
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        //PARA QUE EL FOCO SE VAYA EN EL INPUT
        $(".modal").on('shown.bs.modal', function () {
            $(this).find('input:text:visible:first').focus();
        });

         function registrar_permisos(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: "/T.A/configuraciones/permisos/permisos_add.php?vgrup=" + dat[0] + "&vgrunombre=" + dat[1],
                beforeSend: function () {
                    $('#detalles_registrar').html();
                },
                success: function (msg) {
                    $('#detalles_registrar').html(msg);
                }
            });
        }
        
        
    </script>
</html>


