
<?php
require_once(__DIR__.'/config/config.globales.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Acceso</title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__.'/header/header.php'); ?>

    <!-- Configuración Global JS -->
    <script src="./config/config.globales.js"></script>

    <!-- Login JS -->
    <script src="./js/funciones.login.js"></script>

    <link rel="stylesheet" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE_LIB']?>/bootstraptable/bootstrap-icons.css">

    <style>
        /* Estilo para que la imagen de fondo ocupe toda la pantalla */
        .bg-image {
            background: url('<?php echo CONFIG_GENERAL['RUTA_URL_BASE'] ?>/img/login/background.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh; /* Ocupa toda la altura de la pantalla */
            width: 100vw;  /* Ocupa todo el ancho de la pantalla */
        }

        /* Estilo para el corazón rojo */
        .heart {
            color: red;
            font-size: 1.4em;
        }

        /* Estilo para el texto en cursiva */
        .italic-text {
            font-style: italic;
        }

        /* Estilo para el título más pronunciado */
        .titulo-pronunciado {
            font-weight: 900;
            font-size: 3.5em;
            color: #007bff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            white-space: nowrap;
            margin-top: 100px;
        }

        /* Estilo para el subtítulo " */
        .subtitulo {
            font-weight: 700;
            font-size: 2em;
            font-style: italic;
            color: black; /
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row vh-100">
        <!-- Zona única: imagen de fondo -->
        <div class="col-12 bg-image d-flex justify-content-center align-items-center">
            <!-- Zona del formulario de acceso -->
            <div class="w-100" style="max-width: 400px;">
                <h1 class="text-center mb-4 titulo-pronunciado">ANIMAL CARE</h1>
                <h4 class="text-center mb-4 subtitulo">
                    Donde las mascotas nos importan <i class="bi bi-heart-fill heart"></i>
                </h4>
                <form id="form-login">
                    <div class="mb-3">
                        <label for="form-login-usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="form-login-usuario" placeholder="Introduzca su usuario">
                    </div>
                    <div class="mb-3">
                        <label for="form-login-password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="form-login-password" placeholder="Introduzca su contraseña">
                    </div>
                    <div class="mb-3">
                        <span class="badge" id="form-login-feedback"></span>
                    </div>
                    <button class="btn btn-dark w-100">Acceder</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__.'/header/footer.php'); ?>
<?php include(__DIR__ . '/../header/footer_bootstraptable.php'); ?>
<script>
    document.getElementById("form-login").addEventListener("submit",
        function (event) {
            event.preventDefault();
            enviarFormularioLogin(event);
        }
    );
</script>

</body>
</html>
