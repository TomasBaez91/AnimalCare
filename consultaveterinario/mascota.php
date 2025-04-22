
<?php
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../api/comprobar.sesion.php';
require_once __DIR__ . '/../class/class.Usuario.php';
require_once __DIR__ . '/../class/class.Mascota.php';
require_once __DIR__ . '/../class/class.Consulta.php';

global $usuarioActual;

$id = intval($_GET['id']);
$mascota = new Mascota($id);

# Preparamos el listado de Consultas del mascota *****%%%
$consultas = listadoConsultasMascota($mascota->getId());

$filasConsultasHtml = '';
foreach($consultas as $consulta) {
    $veterinario = new Usuario($consulta['idVeterinario']);

    $filasConsultasHtml .= '<tr>'."\n";
    $filasConsultasHtml .= '    <td>'.obtenerFechaHoraFormateada($consulta['fechaHora'], 'd/m/Y H:i').'</td>'."\n";
    $filasConsultasHtml .= '    <td>'.$veterinario->getNombreCompleto().'</td>'."\n";
    $filasConsultasHtml .= '    <td>'.$consulta['motivoConsulta'].'</td>'."\n";
    $filasConsultasHtml .= '    <td>'."\n";
    $filasConsultasHtml .= '        <button onclick="abrirModalConsultaMascota(this, '.$consulta['id'].')" class="btn btn-sm btn-success">Editar</button>'."\n";
    $filasConsultasHtml .= '        <button onclick="eliminarConsultaMascota(this, '.$consulta['id'].')" class="btn btn-sm btn-danger">Eliminar</button>'."\n";
    $filasConsultasHtml .= '        <a target="_blank" href="../informes/informe.consulta.php?id='.$consulta['id'].'" class="btn btn-sm btn-primary">Informe</a>'."\n";
    $filasConsultasHtml .= '    </td>'."\n";
    $filasConsultasHtml .= '</tr>'."\n";
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Mascota: </title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__ . '/../header/header.php'); ?>
    <?php include(__DIR__ . '/../header/header_bootstraptable.php'); ?>

    <!-- Configuración Global JS -->
    <script src="../config/config.globales.js"></script>

    <!-- JS para la gestión de mascotas -->
    <script src="./js/funciones.mascota.js"></script>
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

<input type="hidden" id="idMascota" value="<?php echo $mascota->getId(); ?>">

<?php include_once __DIR__ . '/../menu/menu.php'; ?>

<?php if ($usuarioActual->getRol() !== 'ADMINISTRADOR') { ?>
<h2>Permiso denegado: No puede acceder a esta área de la aplicación</h2>
<?php } else { ?>

<?php include_once __DIR__ . '/modal/crear.editar.mascota.consulta.php'; ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <h1> Usuario:  <?php echo $usuarioActual->getNombreCompleto()?></h1>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <h3>Datos del Tutor Legal</h3>
            <table id="tablaDatosPersonales" class="table">
                <thead>
                    <tr>
                        <th>Nombre Tutor</th>
                        <th>Teléfono Movil </th>
                        <th>Email</th>
                        <th>NIF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $mascota->getNombreTutor() ?></td>
                        <td><?php echo $mascota->getTelefonoMovil() ?></td>
                        <td><?php echo $mascota->getEmail() ?></td>
                        <td><?php echo $mascota->getNif() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <h3>Datos del Animal</h3>
            <table id="tablaDatosAcceso" class="table">
                <thead>
                <tr>
                    <th>Numero de Chip</th>
                    <th>Nombre de la mascota</th>
                    <th>Fecha de nacimiento</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Sexo</th>

                    <th>Observaciones</th>
                    <th>Alergias</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $mascota->getNumeroChip() ?></td>_____________
                    <td><?php echo $mascota->getNombreMascota() ?></td>
                    <td><?php echo $mascota->getFechaNacimiento() ?></td>
                    <td><?php echo $mascota->getEspecie() ?></td>
                    <td><?php echo $mascota->getRaza() ?></td>
                    <td><?php echo $mascota->getSexo() ?></td>

                    <td><?php echo $mascota->getObservaciones() ?></td>
                    <td><?php echo $mascota->getAlergias() ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            <h3>Consultas</h3>
            <button class="btn btn-sm btn-primary" onclick="abrirModalConsultaMascota(this,0)">Agregar Consulta</button>
            <table id="tablaListadoConsultasMascota" class="table">
                <thead>
                <tr>
                    <th>Fecha/Hora</th>
                    <th>Veterinario</th>
                    <th>Motivo Consulta</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php echo $filasConsultasHtml; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>


<?php include(__DIR__ . '/../header/footer.php'); ?>
<?php } ?>
</html>

