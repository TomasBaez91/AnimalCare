
function abrirModalAdministrativo(boton, id) {
    $("#form-crear-editar-administrativo-id").val(id);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-administrativo-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-administrativo-feedback").html('');

    if (id > 0) {
        $(".form-control").val('');

        let formData = new FormData();
        formData.append('tarea', 'CARGAR_ADMINISTRATIVO');
        formData.append('id', $("#form-crear-editar-administrativo-id").val());

        $.ajax({
            url: RUTA_URL_API + '/api.administrativo.php',
            method: 'POST',
            data: formData, // Enviar el objeto FormData
            contentType: false, // No establecer el encabezado Content-Type manualmente
            processData: false, // No procesar los datos (necesario para FormData)

            success: function (respuesta) {
                if (respuesta.exito === 0) {
                    alert(respuesta.mensaje);
                }

                if (respuesta.exito === 1) {
                    $("#form-crear-editar-administrativo-nombre").val(respuesta.datos.nombre);
                    $("#form-crear-editar-administrativo-apellidos").val(respuesta.datos.apellidos);
                    $("#form-crear-editar-administrativo-email").val(respuesta.datos.email);

                    $("#form-crear-editar-administrativo-bloqueado").prop('checked', respuesta.datos.bloqueado);

                    $("#modal-crear-editar-administrativo").modal("show");
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
        $("#modal-crear-editar-administrativo").modal("show");
    }
}


function guardarAdministrativo(boton) {
    const form = $("#form-crear-editar-administrativo").get(0);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-administrativo-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-administrativo-feedback").html('');

    let formData = new FormData(form);
    formData.append('tarea', 'GUARDAR_ADMINISTRATIVO');
    formData.set('bloqueado', $("#form-crear-editar-administrativo-bloqueado").prop('checked'));

    $.ajax({
        url: RUTA_URL_API + '/api.administrativo.php',
        method: 'POST',
        data: formData, // Enviar el objeto FormData
        contentType: false, // No establecer el encabezado Content-Type manualmente
        processData: false, // No procesar los datos (necesario para FormData)

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                $("#form-crear-editar-administrativo-feedback").addClass('text-bg-danger');
                $("#form-crear-editar-administrativo-feedback").html(respuesta.mensaje);

                if (respuesta.errorEmail == 1) {
                    $("#form-crear-editar-administrativo-email").addClass('is-invalid');
                }

                if (respuesta.errorPassword == 1) {
                    $("#form-crear-editar-administrativo-password1").addClass('is-invalid');
                    $("#form-crear-editar-administrativo-password2").addClass('is-invalid');
                }

                if (respuesta.errorNombreApellidos == 1) {
                    $("#form-crear-editar-administrativo-nombre").addClass('is-invalid');
                    $("#form-crear-editar-administrativo-apellidos").addClass('is-invalid');
                }
            }

            if (respuesta.exito === 1) {
                $("#modal-crear-editar-administrativo").modal("hide");
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}