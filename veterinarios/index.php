<?php
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../api/comprobar.sesion.php';

global $usuarioActual;
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Veterinarios</title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__ . '/../header/header.php'); ?>
    <?php include(__DIR__ . '/../header/header_bootstraptable.php'); ?>

    <!-- Configuración Global JS -->
    <script src="../config/config.globales.js"></script>

    <!-- JS para la gestión de veterinarios -->
    <script src="js/funciones.veterinario.js"></script>
    <style>

        body {
            background: #ADD8E6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
    <style>
        body {
            background: #ADD8E6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Estilo para la tabla */
        .tablaListado {
            border: 2px solid black;
            border-collapse: collapse;
            width: 100%;


        /* Estilo para las celdas de la tabla */
        .tablaListado th, .tablaListado td {
            border: 2px solid black;
            padding: 8px;
            text-align: left

        }

        .tablaListado th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .tablaListado tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tablaListado tr:hover {
            background-color: #ddd;
        }
    </style>

</head>
<body>
<?php include_once(__DIR__ . '/modal/crear.editar.veterinario.php'); ?>

<?php include_once __DIR__ . '/../menu/menu.php'; ?>

<?php if ($usuarioActual->getRol() !== 'ADMINISTRADOR' && $usuarioActual->getRol() !== 'VETERINARIO') { ?>
<h2>Permiso denegado: No puede acceder a esta área de la aplicación</h2>
<?php } else { ?>

<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <h1>Listado de Veterinarios</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-primary btn-lg shadow-lg" onclick="abrirModalVeterinario(this, 0)"> <i class="bi bi-plus-circle"></i> Añadir Veterinario</button>
                </div>
            </div>
            <!-- Tabla listado veterinarios -->

            <div class="row">
                <div class="col-12">
                    <table class="table-striped tablaListado" id="tablaListadoVeterinarios" data-toggle="table"
                           data-url="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']."/veterinarios/GetJSONTablaVeterinarios.php"; ?>"
                           data-unique-id="id"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-toggle="false"
                           data-show-columns="true"
                           data-pagination="true"
                           data-side-pagination="server"
                           data-page-size="15"
                           data-striped="true"
                           data-classes="table table-hover table-condensed"
                           data-page-list="[5, 10, 15, 20, 50, 100, 200]"
                    >
                        <thead>
                        <tr>
                            <th data-width="180" data-field="apellidos" data-sortable="true">Apellidos</th>
                            <th data-width="180" data-field="nombre" data-sortable="true">Nombre</th>
                            <th data-width="150" data-field="email" data-sortable="true">Email</th>
                            <th data-width="150" data-field="rol">Rol</th>
                            <th data-width="50" data-field="acciones">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Tabla listado veterinarios -->
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../header/footer_bootstraptable.php'); ?>
</body>


<?php include(__DIR__ . '/../header/footer.php'); ?>
<?php } ?>
</html>

