<?php
require_once __DIR__.'/../config/config.globales.php';
require_once __DIR__.'/../api/comprobar.sesion.php';

require_once __DIR__.'/../db/class.HandlerDB.php';
require_once __DIR__.'/../class/class.Usuario.php';
require_once __DIR__.'/../class/class.Mascota.php';

/***********************************************************************************
 * Genera la consulta a la DB para obtener el listado de mascotas para la tabla
 ***********************************************************************************/
function generarConsultaListadoTablaMascotas(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $parametrosWhere = array();

    $consultaSql = '
        SELECT
            DISTINCT(m.id)
        FROM 
            '.TABLA_MASCOTAS.' m                
    ';

    if ($textoBusqueda != "") {
        $consultaSql .= ' AND 
            m.idMascota LIKE :textoBusqueda
            OR m.nombreTutor LIKE :textoBusqueda
            OR m.email LIKE :textoBusqueda
            OR m.telefonoMovil LIKE :textoBusqueda
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
        $criterioOrden = ' ORDER BY um.nombreMascota ASC, um.nombreTutor ASC';
    } else {
        $criterioOrden = ' ORDER BY um.'.$sortby.' '.$order;
    }

    if ($limit != 0) {
        $criterioLimit = ' LIMIT '.$limit.' OFFSET '.$offset;
    }

    if (empty($ids)) {
        $ids = []; // Si no hay ids, no hacer la segunda consulta
    }

    if (empty($ids)) {
        return ['totalFilas' => 0, 'datos' => []]; // Retorna vacio si no hay resultados
    }

    $consultaSqlDatos = '
        SELECT
            um.id,
            um.nombreMascota,
            um.nombreTutor,
            um.email,
            um.telefonoMovil
     
        FROM
            '.TABLA_MASCOTAS.' um
        WHERE um.id IN ('.implode(",",$ids).')
        '.$criterioOrden.$criterioLimit;

    $gestorDB->lastQuery = $consultaSqlDatos;
    try {
        $consultaSqlDatos = $gestorDB->dbh->prepare($consultaSqlDatos);
        foreach($parametrosWhere as $parametro => $valor) {
            $consultaSqlDatos->bindValue($parametro, $valor);
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
function listadoTablaMascotas(string $textoBusqueda = "", int $limit = 0, int $offset = 0, string | int $sortby = 0, string | int $order = ""): array | bool {
    $resultadosConsulta = generarConsultaListadoTablaMascotas($textoBusqueda, $limit, $offset, $sortby, $order);

    if ($resultadosConsulta !== false) {
        $jsonDatos = array();

        $i = 0;
        foreach($resultadosConsulta['datos'] as $fila) {
            $jsonDatos[$i]['nombreMascota'] = $fila['nombreMascota'];
            $jsonDatos[$i]['nombreTutor'] = $fila['nombreTutor'];
            $jsonDatos[$i]['email'] = $fila['email'];
            $jsonDatos[$i]['telefonoMovil'] = $fila['telefonoMovil'];
            $jsonDatos[$i]['acciones']  = '<button class="btn btn-primary" onclick="abrirModalMascota(this,'.$fila['id'].')"><i class="bi bi-pencil"></i>Editar</button>';
            $jsonDatos[$i]['acciones'] .= '<a class="btn btn-success ms-1" href="mascota.php?id='.$fila['id'].'"><i class="bi bi-search"></i>Ver</a>';

            $i++;
        }

        $respuesta['total'] = $resultadosConsulta['totalFilas'];
        $respuesta['rows'] = $jsonDatos;

        return $respuesta;
    }

    return false; // Retorna falso si la consulta falla
}

return false;
