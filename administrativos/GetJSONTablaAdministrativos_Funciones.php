<?php
require_once __DIR__.'/../config/config.globales.php';
require_once __DIR__.'/../api/comprobar.sesion.php';

require_once __DIR__.'/../db/class.HandlerDB.php';
require_once __DIR__.'/../class/class.Usuario.php';

/***********************************************************************************
 * Genera la consulta a la DB para obtener el listado de administrativos para la tabla
 ***********************************************************************************/
function generarConsultaListadoTablaAdministrativos(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $parametrosWhere = array();

    $consultaSql = '
        SELECT
            DISTINCT(a.id)
        FROM 
            '.TABLA_USUARIOS.' a        
        WHERE 
            a.rol = :rol                
    ';

    $parametrosWhere[':rol'] = "ADMINISTRATIVO";

    if ($textoBusqueda != "") {
        $consultaSql .= ' AND (
            a.nombre LIKE :textoBusqueda
            OR a.apellidos LIKE :textoBusqueda
            OR a.email LIKE :textoBusqueda
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
        $criterioOrden = ' ORDER BY ua.apellidos ASC, ua.nombre ASC';
    } else {
        $criterioOrden = ' ORDER BY ua.'.$sortby.' '.$order;
    }

    if ($limit != 0) {
        $criterioLimit = ' LIMIT '.$limit.' OFFSET '.$offset;
    }

    if (empty($ids)) {
        $ids = [0];
    }

    $consultaSqlDatos = '
        SELECT
            ua.id,
            ua.nombre,
            ua.apellidos,
            ua.email,
            ua.rol
        FROM
            '.TABLA_USUARIOS.' ua
        WHERE ua.id IN ('.implode(",",$ids).')
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
 * Devuelve el JSON con el listado de administrativos
 ***********************************************************************************/
function listadoTablaAdministrativos(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $resultadosConsulta = generarConsultaListadoTablaAdministrativos($textoBusqueda, $limit, $offset, $sortby, $order);

    if ($resultadosConsulta !== false) {
        $jsonDatos = array();

        $i = 0;
        foreach($resultadosConsulta['datos'] as $fila) {
            $jsonDatos[$i]['nombre'] = $fila['nombre'];
            $jsonDatos[$i]['apellidos'] = $fila['apellidos'];
            $jsonDatos[$i]['email'] = $fila['email'];
            $jsonDatos[$i]['rol'] = $fila['rol'];
            $jsonDatos[$i]['acciones']  = '<button class="btn btn-primary" onclick="abrirModalAdministrativo(this,'.$fila['id'].')"> <i class="bi bi-pencil"></i>Editar</button>';
            $jsonDatos[$i]['acciones'] .= '<a class="btn btn-success ms-1" href="administrativo.php?id='.$fila['id'].'"><i class="bi bi-search"></i>Ver</a>';

            $i++;
        }

        $respuesta['total'] = $resultadosConsulta['totalFilas'];
        $respuesta['rows'] = $jsonDatos;

        return $respuesta;
    }

    return false;
}
