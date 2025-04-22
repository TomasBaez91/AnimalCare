
<?php
require_once __DIR__.'/config/config.globales.php';
require_once __DIR__.'/api/comprobar.sesion.php';

global $usuarioActual;
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Cambiar Contraseña</title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__.'/header/header.php'); ?>

    <!-- Configuración Global JS -->
    <script src="./config/config.globales.js"></script>

    <!-- JS para la gestión de usuarios -->
    <script src="./js/funciones.usuario.js"></script>

    <!-- Estilo para la imagen de fondo -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .bg-image {
            background: url('<?php echo CONFIG_GENERAL['RUTA_URL_BASE'] ?>/img/index/background.jpg') no-repeat center center;
            background-size: cover;
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1; /* Asegura que la imagen quede detrás del contenido */
        }

        .container {
            position: relative;
            z-index: 1; /* Hace que el contenido quede por encima de la imagen */
            padding-top: 50px; /* Para darle algo de espacio en la parte superior */
        }

        h1 {
            color: #333; /* Color de texto para el título */
        }

        .form-control {
            border-radius: 5px; /* Bordes redondeados para los campos */
        }

        .btn-warning {
            background-color: #f39c12; /* Color personalizado para el botón */
            border-color: #e67e22; /* Color del borde del botón */
        }

        .btn-warning:hover {
            background-color: #e67e22; /* Color al pasar el ratón sobre el botón */
            border-color: #f39c12; /* Color del borde cuando el ratón pasa por encima */
        }
    </style>
</head>

<body>

<!-- Imagen de fondo -->
<div class="bg-image"></div>

<?php include_once __DIR__.'/menu/menu.php'; ?>

<div class="container mt-2">
    <div class="row">
        <div class="col-12">
             <h1>¿Quieres cambiar tu contraseña?</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-4" style="max-width: 350px;">
            <form id="form-cambiar-password">
                <div class="mb-3">
                    <label for="form-cambio-password-password-actual" class="form-label">Contraseña Actual</label>
                    <input type="password" class="form-control" name="passwordActual" id="form-cambio-password-password-actual" placeholder="Introduzca su contraseña actual">
                </div>
                <div class="mb-3">
                    <label for="form-cambio-password-password-1" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" name="passwordNueva1" id="form-cambio-password-password-1" placeholder="Introduzca su nueva contraseña">
                </div>
                <div class="mb-3">
                    <label for="form-cambio-password-password-2" class="form-label">Repita su nueva contraseña</label>
                    <input type="password" class="form-control" name="passwordNueva2" id="form-cambio-password-password-2" placeholder="Repita su nueva contraseña">
                </div>
                <div class="mb-3">
                    <span class="badge" id="form-cambio-password-feedback"></span>
                </div>
                <button class="btn btn-warning w-100">Cambiar Contraseña</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("form-cambiar-password").addEventListener("submit",
        function (event) {
            event.preventDefault();
            cambiarPasswordUsuario(event);
        }
    );
</script>

<?php include(__DIR__.'/header/footer.php'); ?>

</body>
</html>
