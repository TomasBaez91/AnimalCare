function abrirModalMascota(boton, id) {
    $("#form-crear-editar-mascota-id").val(id);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-mascota-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-mascota-feedback").html('');

    if (id > 0) {
        $(".form-control").val('');

        let formData = new FormData();
        formData.append('tarea', 'CARGAR_MASCOTA');
        formData.append('id', $("#form-crear-editar-mascota-id").val());

        $.ajax({
            url: RUTA_URL_API + '/api.mascota.php',
            method: 'POST',
            data: formData, // Enviar el objeto FormData
            contentType: false, // No establecer el encabezado Content-Type manualmente
            processData: false, // No procesar los datos (necesario para FormData)

            success: function (respuesta) {
                if (respuesta.exito === 0) {
                    alert(respuesta.mensaje);
                }

                if (respuesta.exito === 1) {
                    $.each(respuesta.datos, function(campo,valor) {
                        $("#form-crear-editar-mascota-"+campo).val(valor);
                    });

                    $("#modal-crear-editar-mascota").modal("show");
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
        $("#modal-crear-editar-mascota").modal("show");
    }
}


function guardarMascota(boton) {
    const form = $("#form-crear-editar-mascota").get(0);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-mascota-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-mascota-feedback").html('');

    let formData = new FormData(form);
    formData.append('tarea', 'GUARDAR_MASCOTA');

    $.ajax({
        url: RUTA_URL_API + '/api.mascota.php',
        method: 'POST',
        data: formData, // Enviar el objeto FormData
        contentType: false, // No establecer el encabezado Content-Type manualmente
        processData: false, // No procesar los datos (necesario para FormData)

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                $("#form-crear-editar-mascota-feedback").addClass('text-bg-danger');
                $("#form-crear-editar-mascota-feedback").html(respuesta.mensaje);

                if (respuesta.errorEmail == 1) {
                    $("#form-crear-editar-mascota-email").addClass('is-invalid');
                }

                if (respuesta.errorNombreApellidos == 1) {
                    $("#form-crear-editar-mascota-nombre").addClass('is-invalid');
                    $("#form-crear-editar-mascota-apellidos").addClass('is-invalid');
                }
            }

            if (respuesta.exito === 1) {
                $("#modal-crear-editar-mascota").modal("hide");
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}


function abrirModalConsultaMascota(boton, id) {
    $("#form-crear-editar-consulta-mascota-id").val(id);

    $(".form-control").removeClass("is-invalid");
    $(".form-control").val("");
    $("#form-crear-editar-consulta-mascota-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-consulta-mascota-feedback").html('');

    if (id > 0) {
        $(".form-control").val('');

        let formData = new FormData();
        formData.append('tarea', 'CARGAR_CONSULTA');
        formData.append('id', $("#form-crear-editar-consulta-mascota-id").val());

        $.ajax({
            url: RUTA_URL_API + '/api.consulta.php',
            method: 'POST',
            data: formData, // Enviar el objeto FormData
            contentType: false, // No establecer el encabezado Content-Type manualmente
            processData: false, // No procesar los datos (necesario para FormData)

            success: function (respuesta) {
                if (respuesta.exito === 0) {
                    alert(respuesta.mensaje);
                }

                if (respuesta.exito === 1) {
                    $.each(respuesta.datos, function(campo,valor) {
                        $("#form-crear-editar-consulta-mascota-"+campo).val(valor);
                    });

                    $("#modal-crear-editar-consulta-mascota").modal("show");
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
        $("#modal-crear-editar-consulta-mascota").modal("show");
    }
}


function guardarConsultaMascota(boton) {
    const form = $("#form-crear-editar-consulta-mascota").get(0);

    $(".form-control").removeClass("is-invalid");
    $("#form-crear-editar-consulta-mascota-feedback").removeClass("text-bg-danger text-bg-success");
    $("#form-crear-editar-consulta-mascota-feedback").html('');

    let formData = new FormData(form);
    formData.append('tarea', 'GUARDAR_CONSULTA');
    formData.append('idMascota', $("#idMascota").val());

    $.ajax({
        url: RUTA_URL_API + '/api.consulta.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                if (respuesta.errorFecha == 1) {
                    $("#form-crear-editar-consulta-mascota-fechaHora").addClass('is-invalid');
                }
                $("#form-crear-editar-consulta-mascota-feedback").addClass('text-bg-danger');
                $("#form-crear-editar-consulta-mascota-feedback").html(respuesta.mensaje);
            }

            if (respuesta.exito === 1) {
                $("#modal-crear-editar-consulta-mascota").modal("hide");
                location.reload();
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}


function eliminarConsultaMascota(boton, id) {
    if (!confirm('¿Está seguro de que desea eliminar la Consulta?')) {
        return false;
    }

    let formData = new FormData();
    formData.append('tarea', 'ELIMINAR_CONSULTA');
    formData.append('id', id);

    $.ajax({
        url: RUTA_URL_API + '/api.consulta.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function (respuesta) {
            if (respuesta.exito === 0) {
                alert(respuesta.mensaje);
            }

            if (respuesta.exito === 1) {
                location.reload();
            }
        }
        ,

        error: function (xhr, status, error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al enviar el formulario');
        }
    });

}