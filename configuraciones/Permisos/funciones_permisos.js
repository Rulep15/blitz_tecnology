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

function borrar(datos) {
    var dat = datos.split("_");
    $('#si').attr('href', 'permisos_control.php?vgru=' + dat[0] + ' &vpag= ' + dat[1] + ' &vgrumbre=' + dat[2]
            + '&consul=null&agre=null&editar=null&borrar=null' + '&accion=3&pagina=permisos_index.php');
    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\ Desea Borrar el Permiso Parar <i><strong>' + dat[1] + '</strong></i>?');
}

$("#mensaje").delay(1500).slideUp(200, function () {
    $(this).alert('close');
});