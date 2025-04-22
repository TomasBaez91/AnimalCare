
<?php
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('Atlantic/Canary');

// CONFIGURACIÓN GENERAL
const CONFIG_GENERAL = array(
    'TITULO_WEB' => 'Clinica Veterinaria Animal Care ',
    'DESCRIPCION_WEB' => 'Clinica Veterinaria Animal Care',
    'RUTA_URL_BASE' => 'http://localhost/AnimalCare',
    'RUTA_URL_BASE_LIB' => 'http://localhost/AnimalCare/lib',
    'RUTA_SERVER_BASE' => __DIR__.'/..',
    'RUTA_SERVER_BASE_LIB' => __DIR__.'/../lib',

    'MAXIMO_INTENTOS_FALLIDOS' => 5,

    'ROLES' => array('ADMINISTRADOR', 'VETERINARIO', 'AUXILIAR', 'ADMINISTRATIVO')
);

// PARÁMETROS SESIONES
const CONFIG_SESIONES = array(
    'NOMBRE_SESION_LOGIN' => 'AnimalCare',
    'DOMINIO_SESION_LOGIN' => 'localhost'
);

const PASSWORD_LONGITUD_MINIMA = 8;

// PARÁMETROS BASE DE DATOS
const CONFIG_DB = array(
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'AnimalCare',
    'DB_LOG_FILE' => __DIR__.'/../log/db.log'
);