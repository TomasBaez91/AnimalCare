
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
    <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Acceso</title>

    <!-- Header Común a todas las páginas de la aplicación -->
    <?php include(__DIR__.'/header/header.php'); ?>

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
        <title><?php echo CONFIG_GENERAL['TITULO_WEB']; ?> - Dashboard</title>

        <!-- Header Común a todas las páginas de la aplicación -->
        <?php include(__DIR__.'/header/header.php'); ?>

        <!-- Configuración Global JS -->
        <script src="./config/config.globales.js"></script>

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
                z-index: -1;
            }

            .container {
                position: relative;
                z-index: 1;
            }

            h1 {
                color: black;
                font-size: 3rem;
                text-align: center;
                font-weight: bold;
            }

            .content {
                background: rgba(255, 255, 255, 0.9);
                padding: 3rem;
                border-radius: 8px;
                margin-top: 2rem;
            }

            .normas {
                margin-top: 2rem;
                padding: 2rem;
                background-color: #f8f9fa;
                border-radius: 8px;
            }

            .normas h2 {
                font-size: 2.5rem;
                font-weight: bold;
                text-align: center;
                margin-bottom: 1rem;
            }

            .normas ul {
                list-style-type: none;
                padding: 0;
            }

            .normas li {
                font-size: 1.2rem;
                margin: 10px 0;
            }

            .normas p {
                font-size: 1rem;
                margin-top: 1rem;
                text-align: justify;
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
                <h2 style="color: #1E90FF; font-family: 'Arial', sans-serif; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); text-align: center; margin: 0;">ANIMAL CARE</h2>

            </div>
        </div>

        <!-- Filosofía de la empresa -->
        <div class="row content">
            <div class="col-12">
                <h2>Filosofía de la Empresa</h2>
                <p>En nuestra clínica veterinaria, estamos comprometidos con el bienestar de las mascotas y su salud integral. Buscamos siempre proporcionar atención de calidad en un ambiente profesional y humano, cuidando no solo a las mascotas, sino también a los clientes y a cada uno de los miembros de nuestro equipo.</p>
                <p>Nos dedicamos a la educación continua y a la mejora constante en todos los aspectos de nuestro trabajo, buscando siempre la excelencia en los servicios que ofrecemos.</p>
            </div>
        </div>

        <!-- Normas Pertinentes -->
        <div class="normas">
            <h2>Guía de Buenas Prácticas:</h2>
            <ul>
                <li><strong>Respeto mutuo</strong>: Tratar con respeto y cortesía a los compañeros de trabajo y clientes.</li>
                <li><strong>Compromiso con la calidad</strong>: Realizar todas las actividades con el más alto nivel de profesionalismo.</li>
                <li><strong>Confidencialidad</strong>: Mantener la información confidencial de las mascotas y los clientes.</li>
                <li><strong>Puntualidad</strong>: Cumplir con los horarios establecidos para citas y tareas.</li>
                <li><strong>Comunicación clara</strong>: Fomentar una comunicación eficiente y efectiva entre todos los miembros del equipo.</li>
                <li><strong>Cuidado de las mascotas</strong>: Asegurarse de que las mascotas reciban la mejor atención en todo momento.</li>
                <li><strong>Formación continua</strong>: Participar en la capacitación continua para mejorar nuestras habilidades.</li>
            </ul>
            <p>Estas normas son fundamentales para asegurar que nuestra clínica se mantenga como un lugar de trabajo armónico y eficiente, brindando siempre el mejor servicio a las mascotas y sus dueños.</p>
        </div>

    </div>

    </body>

    <?php include(__DIR__.'/header/footer.php'); ?>

    </html>
