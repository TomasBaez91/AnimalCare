<?php
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../api/comprobar.sesion.php';
require_once __DIR__ . '/../class/class.Usuario.php';

global $usuarioActual;

$id = intval($_GET['id']);
$usuario = new Usuario($id);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Auxiliar: </title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__ . '/../header/header.php'); ?>

    <!-- Configuración Global JS -->
    <script src="../config/config.globales.js"></script>

    <!-- JS para la gestión de auxiliares -->
    <script src="js/funciones.auxiliares.js"></script>
    <style>

        body {
            background: #ADD8E6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<?php include_once __DIR__ . '/../menu/menu.php'; ?>

<?php if ($usuarioActual->getRol() !== 'ADMINISTRADOR') { ?>
<h2>Permiso denegado: No puede acceder a esta área de la aplicación</h2>
<?php } else { ?>

<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <h1>Auxiliar |  <?php echo $usuario->getNombreCompleto()?></h1>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <h3>Datos Personales</h3>
            <table id="tablaDatosPersonales" class="table">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $usuario->getApellidos() ?></td>
                        <td><?php echo $usuario->getNombre() ?></td>
                        <td><?php echo $usuario->getEmail() ?></td>
                        <td><?php echo $usuario->getRol() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <h3>Datos de Acceso</h3>
            <table id="tablaDatosAcceso" class="table">
                <thead>
                <tr>
                    <th>Último Acceso</th>
                    <th>Intentos Fallidos</th>
                    <th>Bloqueado</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $usuario->getFechaHoraUltimoAcceso(true) ?></td>
                    <td><?php echo $usuario->getIntentosFallidos() ?></td>
                    <td><?php echo ($usuario->getBloqueado()) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>


<?php include(__DIR__ . '/../header/footer.php'); ?>
<?php } ?>
</html>

