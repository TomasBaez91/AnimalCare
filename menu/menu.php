<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00008B;"> <!-- Azul oscuro con texto blanco -->
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/veterinarios/veterinario.php?id=<?php echo $usuarioActual->getId()?>">Consultas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/veterinarios">Veterinarios</a></li>
                        <li><a class="dropdown-item" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/auxiliares">Auxiliares</a></li>
                        <li><a class="dropdown-item" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/administrativos">Administrativos</a></li>
                        <li><a class="dropdown-item" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/mascotas">Mascotas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo CONFIG_GENERAL['RUTA_URL_BASE']?>/cambiarPassword.php">Cambiar Contraseña</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
