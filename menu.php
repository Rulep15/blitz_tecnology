<?php session_start() ?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maxium-scalable=no"name="viewport">
    </head>
    <?php
    include './conexion.php';
    require './estilos/css_lte.ctp';
    ?>
    <body class="hold-transition skin-purple sidebar-mini" >
        <div style="background-color: #1E282C;">
            <?php require './estilos/cabecera.ctp'; ?>
            <?php require './estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: #BBBBBB;">
                <section class="content-header">
                    <section class="content">
                        <h3>
                            Bienvenido al Sistema <?php echo '- ', $_SESSION['nombres']; ?>
                        </h3>
                    </section>
                </section>    
            </div>
        </div>
        <?php require './estilos/pie.ctp'; ?>
    </body>
    <?php require './estilos/js_lte.ctp'; ?>
</html>




