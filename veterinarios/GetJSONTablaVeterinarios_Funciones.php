<?php
require_once __DIR__.'/../config/config.globales.php';
require_once __DIR__.'/../api/comprobar.sesion.php';

require_once __DIR__.'/../db/class.HandlerDB.php';
require_once __DIR__.'/../class/class.Usuario.php';

/***********************************************************************************
 * Genera la consulta a la DB para obtener el listado de veterinarios para la tabla
 ***********************************************************************************/
function generarConsultaListadoTablaVeterinarios(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $parametrosWhere = array();

    $consultaSql = '
        SELECT
            DISTINCT(v.id)
        FROM 
            '.TABLA_USUARIOS.' v       
        WHERE 
            v.rol = :rol                
    ';

    $parametrosWhere[':rol'] = "VETERINARIO";

    if ($textoBusqueda != "") {
        $consultaSql .= ' AND (
            v.nombre LIKE :textoBusqueda
            OR v.apellidos LIKE :textoBusqueda
            OR v.email LIKE :textoBusqueda
        )';
        $parametrosWhere[':textoBusqueda'] = "%{$textoBusqueda}%";
    }

    $gestorDB = new HandlerDB();
    $gestorDB->lastQuery = $consultaSql;
    try {
        $consultaSql = $gestorDB->dbh->prepare($consultaSql);
        foreach($parametrosWhere as $parametro => $valor) {
            $consultaSql->bindValue($parametro, $valor);
        }
        $consultaSql->execute();
        $ids = $consultaSql->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        $mensajeLog = date('Y-m-d H:i:s').": ".$e->getMessage();
        file_put_contents(FICHERO_LOG_DB, $mensajeLog.PHP_EOL.$gestorDB->lastQuery.PHP_EOL.PHP_EOL, FILE_APPEND);
        $gestorDB->error = $e->getMessage();
        return false;
    }

    $totalFilas = $consultaSql->rowCount();

    if ($sortby === 0) {
        $criterioOrden = ' ORDER BY uv.apellidos ASC, uv.nombre ASC';
    } else {
        $criterioOrden = ' ORDER BY uv.'.$sortby.' '.$order;
    }

    if ($limit != 0) {
        $criterioLimit = ' LIMIT '.$limit.' OFFSET '.$offset;
    }

    if (empty($ids)) {
        $ids = [0];
    }

    $consultaSqlDatos = '
        SELECT
            uv.id,
            uv.nombre,
            uv.apellidos,
            uv.email,
            uv.rol
        FROM
            '.TABLA_USUARIOS.' uv
        WHERE uv.id IN ('.implode(",",$ids).')
        '.$criterioOrden.$criterioLimit;

    $gestorDB->lastQuery = $consultaSqlDatos;
    try {
        $consultaSqlDatos = $gestorDB->dbh->prepare($consultaSqlDatos);
        foreach($parametrosWhere as $parametro => $valor) {
            $consultaSql->bindValue($parametro, $valor);
        }
        $consultaSqlDatos->execute();
        $resultados = $consultaSqlDatos->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $mensajeLog = date('Y-m-d H:i:s').": ".$e->getMessage();
        file_put_contents(FICHERO_LOG_DB, $mensajeLog.PHP_EOL.$gestorDB->lastQuery.PHP_EOL.PHP_EOL, FILE_APPEND);
        $gestorDB->error = $e->getMessage();
        return false;
    }

    $respuesta = array();
    $respuesta['datos'] = $resultados;
    $respuesta['totalFilas'] = $totalFilas;

    return $respuesta;
}

/***********************************************************************************
 * Devuelve el JSON con el listado de veterinarios
 ***********************************************************************************/
function listadoTablaVeterinarios(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $resultadosConsulta = generarConsultaListadoTablaVeterinarios($textoBusqueda, $limit, $offset, $sortby, $order);

    if ($resultadosConsulta !== false) {
        $jsonDatos = array();

        $i = 0;
        foreach($resultadosConsulta['datos'] as $fila) {
            $jsonDatos[$i]['nombre'] = $fila['nombre'];
            $jsonDatos[$i]['apellidos'] = $fila['apellidos'];
            $jsonDatos[$i]['email'] = $fila['email'];
            $jsonDatos[$i]['rol'] = $fila['rol'];
            $jsonDatos[$i]['acciones']  = '<button class="btn btn-primary" onclick="abrirModalVeterinario(this,'.$fila['id'].')"><i class="bi bi-pencil"></i>Editar</button>';
            $jsonDatos[$i]['acciones'] .= '<a class="btn btn-success ms-1" href="veterinario.php?id='.$fila['id'].'"><i class="bi bi-search"></i>Ver</a>';

            $i++;
        }

        $respuesta['total'] = $resultadosConsulta['totalFilas'];
        $respuesta['rows'] = $jsonDatos;

        return $respuesta;
    }

    return false;
}
