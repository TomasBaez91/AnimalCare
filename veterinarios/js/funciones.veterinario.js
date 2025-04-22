
function abrirModalVeterinario(boton, id) {
    $("#form-crear-editar-veterinario-id").val(id);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-veterinario-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-veterinario-feedback").html('');

    if (id > 0) {
        $(".form-control").val('');

        let formData = new FormData();
        formData.append('tarea', 'CARGAR_VETERINARIO');
        formData.append('id', $("#form-crear-editar-veterinario-id").val());

        $.ajax({
            url: RUTA_URL_API + '/api.veterinario.php',
            method: 'POST',
            data: formData, // Enviar el objeto FormData
            contentType: false, // No establecer el encabezado Content-Type manualmente
            processData: false, // No procesar los datos (necesario para FormData)

            success: function (respuesta) {
                if (respuesta.exito === 0) {
                    alert(respuesta.mensaje);
                }

                if (respuesta.exito === 1) {
                    $("#form-crear-editar-veterinario-nombre").val(respuesta.datos.nombre);
                    $("#form-crear-editar-veterinario-apellidos").val(respuesta.datos.apellidos);
                    $("#form-crear-editar-veterinario-email").val(respuesta.datos.email);

                    $("#form-crear-editar-veterinario-bloqueado").prop('checked', respuesta.datos.bloqueado);

                    $("#modal-crear-editar-veterinario").modal("show");
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
        $("#modal-crear-editar-veterinario").modal("show");
    }
}


function guardarVeterinario(boton) {
    const form = $("#form-crear-editar-veterinario").get(0);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-veterinario-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-veterinario-feedback").html('');

    let formData = new FormData(form);
    formData.append('tarea', 'GUARDAR_VETERINARIO');
    formData.set('bloqueado', $("#form-crear-editar-veterinario-bloqueado").prop('checked'));

    $.ajax({
        url: RUTA_URL_API + '/api.veterinario.php',
        method: 'POST',
        data: formData, // Enviar el objeto FormData
        contentType: false, // No establecer el encabezado Content-Type manualmente
        processData: false, // No procesar los datos (necesario para FormData)

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                $("#form-crear-editar-veterinario-feedback").addClass('text-bg-danger');
                $("#form-crear-editar-veterinario-feedback").html(respuesta.mensaje);

                if (respuesta.errorEmail == 1) {
                    $("#form-crear-editar-veterinario-email").addClass('is-invalid');
                }

                if (respuesta.errorPassword == 1) {
                    $("#form-crear-editar-veterinario-password1").addClass('is-invalid');
                    $("#form-crear-editar-veterinario-password2").addClass('is-invalid');
                }

                if (respuesta.errorNombreApellidos == 1) {
                    $("#form-crear-editar-veterinario-nombre").addClass('is-invalid');
                    $("#form-crear-editar-veterinario-apellidos").addClass('is-invalid');
                }
            }

            if (respuesta.exito === 1) {
                $("#modal-crear-editar-veterinario").modal("hide");
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}