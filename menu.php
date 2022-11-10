<?php session_start() ?>

<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=devicewidth, initial-scale=1, maxium-scalable=no" name="viewport">
</head>

<?php
include './conexion.php';
require './estilos/css_lte.ctp';
?>

<body class="hold-transition skin-purple sidebar-mini">
    <div style="background-color: #1E282C;">
        <?php require './estilos/cabecera.ctp'; ?>
        <?php require './estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #272829;">
            <section class="content-header">
                <section class="content">
                    <h3  style="color: white; font-size: 50px; font-family: Time New Roman; font-style: italic;">
                        Bienvenido al Sistema <?php echo '- ', $_SESSION['nombres']; ?>
                    </h3>
                    <br><br>
                    <br>
                    <img src="./img/menu/menu1.gif" style="width: 900px; height: 500px;">
                </section>
            </section>
        </div>
    </div>
    <?php require './estilos/pie.ctp'; ?>
</body>
<?php require './estilos/js_lte.ctp'; ?>

</html>