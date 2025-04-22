
function abrirModalAuxiliar(boton, id) {
    $("#form-crear-editar-auxiliar-id").val(id);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-auxiliar-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-auxiliar-feedback").html('');

    if (id > 0) {
        $(".form-control").val('');

        let formData = new FormData();
        formData.append('tarea', 'CARGAR_AUXILIAR');
        formData.append('id', $("#form-crear-editar-auxiliar-id").val());

        $.ajax({
            url: RUTA_URL_API + '/api.auxiliar.php',
            method: 'POST',
            data: formData, // Enviar el objeto FormData
            contentType: false, // No establecer el encabezado Content-Type manualmente
            processData: false, // No procesar los datos (necesario para FormData)

            success: function (respuesta) {
                if (respuesta.exito === 0) {
                    alert(respuesta.mensaje);
                }

                if (respuesta.exito === 1) {
                    $("#form-crear-editar-auxiliar-nombre").val(respuesta.datos.nombre);
                    $("#form-crear-editar-auxiliar-apellidos").val(respuesta.datos.apellidos);
                    $("#form-crear-editar-auxiliar-email").val(respuesta.datos.email);

                    $("#form-crear-editar-auxiliar-bloqueado").prop('checked', respuesta.datos.bloqueado);

                    $("#modal-crear-editar-auxiliar").modal("show");
                }
            }
            ,

            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                alert('Ocurrió un error al enviar el formulario');
            }
        });
    } else {
        $(".form-control").val('');
        $("#modal-crear-editar-auxiliar").modal("show");
    }
}


function guardarAuxiliar(boton) {
    const form = $("#form-crear-editar-auxiliar").get(0);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-auxiliar-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-auxiliar-feedback").html('');

    let formData = new FormData(form);
    formData.append('tarea', 'GUARDAR_AUXILIAR');
    formData.set('bloqueado', $("#form-crear-editar-auxiliar-bloqueado").prop('checked'));

    $.ajax({
        url: RUTA_URL_API + '/api.auxiliar.php',
        method: 'POST',
        data: formData, // Enviar el objeto FormData
        contentType: false, // No establecer el encabezado Content-Type manualmente
        processData: false, // No procesar los datos (necesario para FormData)

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                $("#form-crear-editar-auxiliar-feedback").addClass('text-bg-danger');
                $("#form-crear-editar-auxiliar-feedback").html(respuesta.mensaje);

                if (respuesta.errorEmail == 1) {
                    $("#form-crear-editar-auxiliar-email").addClass('is-invalid');
                }

                if (respuesta.errorPassword == 1) {
                    $("#form-crear-editar-auxiliar-password1").addClass('is-invalid');
                    $("#form-crear-editar-auxiliar-password2").addClass('is-invalid');
                }

                if (respuesta.errorNombreApellidos == 1) {
                    $("#form-crear-editar-auxiliar-nombre").addClass('is-invalid');
                    $("#form-crear-editar-auxiliar-apellidos").addClass('is-invalid');
                }
            }

            if (respuesta.exito === 1) {
                $("#modal-crear-editar-auxiliar").modal("hide");
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}