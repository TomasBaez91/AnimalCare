<?php
require_once __DIR__.'/../config/config.globales.php';
require_once __DIR__.'/../api/comprobar.sesion.php';

require_once __DIR__.'/../db/class.HandlerDB.php';
require_once __DIR__.'/../class/class.Usuario.php';

/***********************************************************************************
 * Genera la consulta a la DB para obtener el listado de Auxiliares para la tabla
 ***********************************************************************************/
function generarConsultaListadoTablaAuxiliares(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $parametrosWhere = array();

    $consultaSql = '
        SELECT
            DISTINCT(au.id)
        FROM 
            '.TABLA_USUARIOS.' au        
        WHERE 
            au.rol = :rol                
    ';

    $parametrosWhere[':rol'] = "AUXILIAR";

    if ($textoBusqueda != "") {
        $consultaSql .= ' AND (
            au.nombre LIKE :textoBusqueda
            OR au.apellidos LIKE :textoBusqueda
            OR au.email LIKE :textoBusqueda
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
        $criterioOrden = ' ORDER BY ux.apellidos ASC, ux.nombre ASC';
    } else {
        $criterioOrden = ' ORDER BY ux.'.$sortby.' '.$order;
    }

    if ($limit != 0) {
        $criterioLimit = ' LIMIT '.$limit.' OFFSET '.$offset;
    }

    if (empty($ids)) {
        $ids = [0];
    }

    $consultaSqlDatos = '
        SELECT
            ux.id,
            ux.nombre,
            ux.apellidos,
            ux.email,
            ux.rol
        FROM
            '.TABLA_USUARIOS.' ux
        WHERE ux.id IN ('.implode(",",$ids).')
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
 * Devuelve el JSON con el listado de Auxiliares
 ***********************************************************************************/
function listadoTablaAuxiliares(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $resultadosConsulta = generarConsultaListadoTablaAuxiliares($textoBusqueda, $limit, $offset, $sortby, $order);

    if ($resultadosConsulta !== false) {
        $jsonDatos = array();

        $i = 0;
        foreach($resultadosConsulta['datos'] as $fila) {
            $jsonDatos[$i]['nombre'] = $fila['nombre'];
            $jsonDatos[$i]['apellidos'] = $fila['apellidos'];
            $jsonDatos[$i]['email'] = $fila['email'];
            $jsonDatos[$i]['rol'] = $fila['rol'];
            $jsonDatos[$i]['acciones']  = '<button class="btn btn-primary" onclick="abrirModalAuxiliar(this,'.$fila['id'].')"> 
                                <i class="bi bi-pencil"></i> Editar
                              </button>';

            $jsonDatos[$i]['acciones'] .= '<a class="btn btn-success ms-1" href="auxiliar.php?id='.$fila['id'].'"><i class="bi bi-search"></i>Ver</a>';

            $i++;
        }

        $respuesta['total'] = $resultadosConsulta['totalFilas'];
        $respuesta['rows'] = $jsonDatos;

        return $respuesta;
    }

    return false;
}
