<?php

require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__.'/comprobar.sesion.php';
require_once __DIR__ . '/../db/class.HandlerDB.php';
require_once __DIR__ . '/../class/function.globales.php';
require_once __DIR__ . '/../class/class.Mascota.php';

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
    case 'CARGAR_MASCOTA':
        $id = intval($_POST['id']);
        $mascota = new Mascota($id);
        if ($mascota->getId() == 0) {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'No se pudo cargar los datos del mascota';
            break;
        }
        $datos['id'] = $mascota->getId();
        $datos['nombreTutor'] = $mascota->getNombreTutor();
        $datos['telefonoMovil'] = $mascota->getTelefonoMovil();
        $datos['email'] = $mascota->getEmail();
        $datos['nif'] = $mascota->getNif();
        $datos['numeroChip'] = $mascota->getNumeroChip();
        $datos['nombreMascota'] = $mascota->getNombreMascota();
        $datos['fechaNacimiento'] = $mascota->getFechaNacimiento();
        $datos['especie'] = $mascota->getEspecie();
        $datos['raza'] = $mascota->getRaza();
        $datos['sexo'] = $mascota->getSexo();
        $datos['expedienteAnimal'] = $mascota->getExpedienteAnimal();
        $datos['observaciones'] = $mascota->getObservaciones();
        $datos['alergias'] = $mascota->getAlergias();

        $respuesta['exito'] = 1;
        $respuesta['datos'] = $datos;
        break;

    case 'GUARDAR_MASCOTA':
        $id = intval($_POST['id']);
        $mascota = new Mascota($id);

        $nombreMascota = sanitizarString(trim($_POST["nombreMascota"]));
        $nombreTutor = sanitizarString(trim($_POST["nombreTutor"]));

        if (strlen($nombreMascota) == 0 || strlen($nombreTutor) == 0) {
            $respuesta['exito'] = 0;
            $respuesta['errorNombreApellidos'] = 1;
            $respuesta['mensaje'] = 'Debe rellenar el nombre del animal y el nombre del tutor';
            break;
        }

        $mascota->setNombreMascota(sanitizarString($_POST["nombreMascota"]));
        $mascota->setNombreTutor(sanitizarString($_POST["nombreTutor"]));

        if (!$mascota->setEmail(sanitizarString($_POST["email"]))) {
            $respuesta['exito'] = 0;
            $respuesta['errorEmail'] = 1;
            $respuesta['mensaje'] = 'El email no es valido';
            break;
        }

        $mascota->setTelefonoMovil(intval($_POST["telefonoMovil"]));
        $mascota->setNif(sanitizarString($_POST["nif"]));
        $mascota->setExpedienteAnimal(sanitizarString($_POST["expedienteAnimal"]));
        $mascota->setnumeroChip(sanitizarString($_POST["numeroChip"]));
        $mascota->setObservaciones(sanitizarString($_POST["observaciones"]));
        $mascota->setAlergias(sanitizarString($_POST["alergias"]));
        $mascota->setEspecie(sanitizarString($_POST["especie"]));
        $mascota->setRaza(sanitizarString($_POST["raza"]));
        $mascota->setSexo(sanitizarString($_POST["sexo"]));
        $mascota->setFechaNacimiento(sanitizarString($_POST["fechaNacimiento"]));

        if ($mascota->guardar()) {
            $respuesta['exito'] = 1;
        } else {
            $respuesta['exito'] = 0;
            $respuesta['mensaje'] = 'Ha ocurrido un error al intentar guardar los datos de la mascota';
        }
        break;

    default:
        $respuesta['exito'] = 0;
        $respuesta['mensaje'] = 'Error en la petición';
        break;
}

//ob_clean();
header('Content-Type: application/json');
echo json_encode($respuesta);
