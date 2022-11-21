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
        <style>
            .header {
                background-color: rgb(37, 150, 190);
                color: white;
            }
            .btn-header {
                background-color: white;
                color: black;
            }
            /*Sombreado para los input*/
            input:hover{
                box-shadow: 0 1px 5px #333;
            }
        </style> 
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #e9f5f9;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="header box-header">
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Anular Usuario</h3>
                                    <div class="box-tools">
                                        <a href="usuario_index.php" class="btn-header btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="usuario_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_usuario WHERE usu_cod = " . $_GET['vusucod']); ?>

                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vusucod" value="<?php echo $resultado[0]['usu_cod']; ?>"/> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Nick</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <input class="form-control" type="text" name="vnick" required="" disabled="" value="<?php echo $resultado[0]['usu_nick']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Empleado</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <input class="form-control" type="text" name="vempleado" required="" disabled="" value="<?php echo $resultado[0]['emp_nombre']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Sucursal</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <input class="form-control" type="text" name="vsucursal" required="" disabled="" value="<?php echo $resultado[0]['suc_descri']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-sm-2 col-xs-4">Grupo</label>
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <input class="form-control" type="text" name="vgrupo" required="" disabled="" value="<?php echo $resultado[0]['gru_nombre']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-danger btn-lg" type="submit">Anular</button>
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