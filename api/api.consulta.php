<?php
ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__.'/comprobar.sesion.php';
require_once __DIR__ . '/../db/class.HandlerDB.php';
require_once __DIR__ . '/../class/function.globales.php';
require_once __DIR__ . '/../class/class.Consulta.php';
require_once __DIR__ . '/../class/class.Mascota.php';
require_once __DIR__ . '/../class/class.MensajeEmail.php';

/* @var Usuario $usuarioActual */
global $usuarioActual;

// Comprobamos que se ha accedido a esta api mediante POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Método no permitido
    exit;
}

// Comprobamos que existe el campo tarea
$tarea = $_POST['tarea'] ?? null;
if (is_null($tarea)) {
    header('Content-Type: application/json');
    echo json_encode(['exito' => 0, 'mensaje' => 'No se ha recibido ninguna tarea']);
    exit;
}


$respuesta = array();
switch($tarea) {
    case 'CARGAR_CONSULTA':
        $id = intval($_POST['id']);
        $consulta = new Consulta($id);
        if ($consulta->getId() == 0) {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'No se pudo cargar los datos de la consulta';
            break;
        }

        $datos['id'] = $consulta->getId();
        $datos['fechaHora'] = $consulta->getFechaHora();
        $datos['idMascota'] = $consulta->getIdMascota();
        $datos['idVeterinario'] = $consulta->getIdVeterinario();
        $datos['motivoConsulta'] = $consulta->getMotivoConsulta();

        $respuesta['exito'] = 1;
        $respuesta['datos'] = $datos;
        break;

    case 'GUARDAR_CONSULTA':
        $id = intval($_POST['id']);
        $consulta = new Consulta($id);

        $consulta->setMotivoConsulta(sanitizarString($_POST['motivoConsulta']));
        $idMascota = intval($_POST['idMascota']);
        $idVeterinario = intval($_POST['idVeterinario']);

        if ($idMascota == 0 && $idVeterinario == 0) {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'La consulta debe tener un Veterinario o un animal asociado';
            break;
        }

        $consulta->setIdMascota($idMascota);
        $consulta->setIdVeterinario($idVeterinario);

        if (!validarFecha($_POST['fechaHora'])) {
            $respuesta['exito'] = 0;
            $respuesta['errorFecha'] = 1;
            $respuesta['mensaje'] = 'La fecha no es válida';
            break;
        }

        $consulta->setFechaHora($_POST['fechaHora']);

        if ($consulta->guardar()) {
            $respuesta['exito'] = 1;

            //enviar email al dueño de la mascota  de confirmacion de cita
            $mascota = new Mascota($idMascota);
            $mensaje = new MensajeEmail();
            $mensaje->setIdUsuario($usuarioActual->getId());
            $mensaje->setAsunto('Consulta confirmada');
            $mensaje->setCuerpoMensaje('Su consulta veterinaria  ha sido confirmada.Tiene cita el  '.$consulta->getFechaHora(true).'<br>Si no puede acudir, avise con antelación, gracias');
            $mensaje->setDestinatarios([['nombre' => $mascota->getNombreTutor(), 'email' => $mascota->getEmail()]]);
            $mensaje->setFechaHoraCreacion(date('Y-m-d H:i:s'));
            $mensaje->guardar();
            $mensaje->enviar();
        } else {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'Ha ocurrido un error al intentar guardar la consulta';
        }
        break;

    case 'ELIMINAR_CONSULTA':
        $id = intval($_POST['id']);
        $consulta = new Consulta($id);
        if ($consulta->eliminar()) {
            $respuesta['exito'] = 1;
            //enviar email al paciente  de cancelacion de cita
            $mascota = new Mascota($consulta->getIdMascota());
            $mensaje = new MensajeEmail();
            $mensaje->setIdUsuario($usuarioActual->getId());
            $mensaje->setAsunto('Consulta Cancelada');
            $mensaje->setCuerpoMensaje('Consulta Cancelada'.$consulta->getFechaHora(true).'<br>Disculpe las molestias, su consulta ha sido cancelada,cualquier duda contacte con nosotros');
            $mensaje->setDestinatarios([['nombre' => $mascota->getNombreTutor(), 'email' => $mascota->getEmail()]]);
            $mensaje->setFechaHoraCreacion(date('Y-m-d H:i:s'));
            $mensaje->guardar();
            $mensaje->enviar();
        } else {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'No se ha podido eliminar la consulta';
        }
        break;

    default:
        $respuesta['exito'] = 0;
        $respuesta['mensaje'] = 'Error en la petición';
        break;
}

ob_clean();
header('Content-Type: application/json');
echo json_encode($respuesta);
