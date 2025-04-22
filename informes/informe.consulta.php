<?php
// Requerir archivos de configuración y clases
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../api/comprobar.sesion.php';
require_once __DIR__ . '/../class/class.Usuario.php';
require_once __DIR__ . '/../class/class.Consulta.php';
require_once __DIR__ . '/../class/class.Mascota.php';

// Incluir la librería de mPDF
require_once __DIR__.'/../lib/mpdf/vendor/autoload.php';

// Obtener los parámetros de la URL
$consultaId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($consultaId <= 0) {
    die('Consulta no válida');
}

// Crear objetos de consulta y mascota
$consulta = new Consulta($consultaId);
$mascota = new Mascota($consulta->getIdMascota());

// Generar el contenido HTML para el informe
$codigoHTML = generateHTMLContent($mascota, $consulta);

// Crear objeto mPDF y configurar sus opciones
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 15,
    'margin_bottom' => 15,
]);

// Establecer el título del documento PDF
$mpdf->SetTitle('Informe de Consulta Veterinaria');

// Configuración de la codificación
$mpdf->charset_in = "UTF-8";

// Incluir los estilos CSS (si los tienes en un archivo)
$hojaEstilos = file_get_contents(__DIR__ . "/css/estilospdf.css");
$mpdf->WriteHTML($hojaEstilos, 1);

// Escribir el contenido HTML
$mpdf->WriteHTML($codigoHTML, 2);

// Generar el PDF y mostrarlo en el navegador
$mpdf->Output('informe_consulta.pdf', \Mpdf\Output\Destination::INLINE);

// Función para generar el contenido HTML para el informe
function generateHTMLContent($mascota, $consulta) {
    // Obtener los datos de la mascota y la consulta
    $idVeterinario = htmlspecialchars($consulta->getIdVeterinario());
    $nombreMascota = htmlspecialchars($mascota->getNombreMascota());
    $numeroChip = htmlspecialchars($mascota->getNumeroChip());
    $especie = htmlspecialchars($mascota->getEspecie());
    $raza = htmlspecialchars($mascota->getRaza());
    $sexo = htmlspecialchars($mascota->getSexo());
    $alergias = htmlspecialchars($mascota->getAlergias());
    $expedienteAnimal = htmlspecialchars($mascota->getExpedienteAnimal());
    $fechaNacimiento = htmlspecialchars($mascota->getFechaNacimiento());
    $observaciones = htmlspecialchars($mascota->getObservaciones());
    $fechaHora = htmlspecialchars($consulta->getFechaHora(true));
    $motivoConsulta = htmlspecialchars($consulta->getMotivoConsulta());
    $fechaActual = date('d') . ' de ' . getMesSpanish(date('n')) . ' de ' . date('Y');

    // Construir el contenido HTML
    $html = '
        <h1 style="text-align: center;font-weight: bold; font-size: 24px">ANIMAL CARE </h1>
        <h2 style="text-align: center;">Informe de Consulta Veterinaria</h2>
        <table style="width: 100%; border: 3px solid #555; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;">Nombre de la Mascota</th>
                    <th style="width: 25%; padding: 8px; text-align: left;">Especie</th>
                    <th style="width: 25%; padding: 8px; text-align: left;">Fecha de la Consulta</th>
                    <th style="width: 25%; padding: 8px; text-align: left;">ID Veterinario</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">' . $nombreMascota . '</td>
                    <td style="padding: 8px;">' . $especie . '</td>
                    <td style="padding: 8px;">' . $fechaHora . '</td>
                      <td style="padding: 8px;">' . $idVeterinario . '</td>
               
                </tr>
            </tbody>
        </table>

        <h2 style="margin-top: 20px;">Perfil del animal</h2>
        <table style="width: 100%; border: 2px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;">Raza</th>
                    <th style="width: 25%; padding: 8px; text-align: left;">Sexo</th>
                    <th style="width: 25%; padding: 8px; text-align: left;">Fecha Nacimiento</th>
                      <th style="width: 25%; padding: 8px; text-align: left;">Numero de chip</th>
             
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">' . $raza . '</td>
                    <td style="padding: 8px;">' . $sexo . '</td>
                    <td style="padding: 8px;">' . $fechaNacimiento . '</td>
                      <td style="padding: 8px;">' . $numeroChip . '</td>
                   
         
                </tr>
            </tbody>
        </table>
         <h2 style="margin-top: 20px;">Ficha Veterinaria</h2>
    <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;"> Alergias </th>
                     </tr>
            </thead>
            <tbody>
                <tr>
                        <td style="padding: 8px;">' . $alergias . '</td>
                     </tr>
            </tbody>
        </table>
         <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;"> Observaciones </th>
                     </tr>
            </thead>
            <tbody>
                <tr>
                        <td style="padding: 8px;">' . $observaciones . '</td>
                     </tr>
            </tbody>
        </table>
        <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;"> Expediente Veterinario </th>
                     </tr>
            </thead>
            <tbody>
                <tr>
                        <td style="padding: 8px;">' . $expedienteAnimal . '</td>
                     </tr>
            </tbody>
        </table>
        <table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%; padding: 8px; text-align: left;"> Motivo de la consulta </th>
                     </tr>
            </thead>
            <tbody>
                <tr>
                        <td style="padding: 8px;">' . $motivoConsulta . '</td>
                     </tr>
            </tbody>
        </table>
                    
        <p style="text-align: right; margin-top: 20px;font-weight: bold; font-size: 24px">
            LAS PALMAS DE GRAN CANARIA, ' . $fechaActual . '
        </p>
    ';

    return $html;
}
?>
