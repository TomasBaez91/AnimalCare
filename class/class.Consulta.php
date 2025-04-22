<?php
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../db/class.HandlerDB.php';
require_once __DIR__ . '/function.globales.php';
require_once __DIR__ . '/abstract.class.ObjetoDB.php';

class Consulta extends ObjetoDB {
    protected int $id = 0;
    protected int $idMascota = 0;
    protected int $idVeterinario = 0;
    protected string $fechaHora = "";
    protected string $motivoConsulta = "";


    public function __construct(int $id = 0, string $otraClave = "", $valorOtraClave = "") {
        parent::__construct($id, $otraClave, $valorOtraClave);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdMascota(): int {
        return $this->idMascota;
    }

    public function setIdMascota(int $idMascota): void {
        $this->idMascota = $idMascota;
    }

    public function getIdVeterinario(): int {
        return $this->idVeterinario;
    }

    public function setIdVeterinario(int $idVeterinario): void {
        $this->idVeterinario = $idVeterinario;
    }

    public function getFechaHora(bool $formateada = false): string | null {
        if (is_null($this->fechaHora)) {
            return null;
        }

        if ($formateada) {
            return date('d/m/Y H:i', strtotime($this->fechaHora));
        }

        return $this->fechaHora;
    }

    public function setFechaHora(string | null $fechaHora): void {
        if ($fechaHora == "") {
            $this->fechaHora = null;
        } else {
            $this->fechaHora = $fechaHora;
        }
    }

    public function getMotivoConsulta(): string {
        return $this->motivoConsulta;
    }

    public function setMotivoConsulta(string $motivoConsulta): void {
        $this->motivoConsulta = sanitizarString($motivoConsulta);
    }


    public function guardar(): bool {
        if ($this->fechaHora == "") {
            return false;
        }

        return parent::guardar();
    }
}

function listadoConsultasMascota(int $idMascota): array {
    $gestorDB = new HandlerDB();
    $registros = $gestorDB->obtenerRegistros(
        TABLA_CONSULTAS,
        ['*'],
        'idMascota = :idMascota',
        [':idMascota' => $idMascota],
        null,
        'FETCH_ASSOC'
    );

    if (isset($registros[0]['id']) && $registros[0]['id'] > 0) {
        return $registros;
    }

    return [];
}
function listadoConsultasVeterinario(int $idVeterinario): array {
    $gestorDB = new HandlerDB();
    $registros = $gestorDB->obtenerRegistros(
        TABLA_CONSULTAS,
        ['*'],
        'idVeterinario = :idVeterinario',
        [':idVeterinario' => $idVeterinario],
        null,
        'FETCH_ASSOC'
    );

    if (isset($registros[0]['id']) && $registros[0]['id'] > 0) {
        return $registros;
    }

    return [];
}
?>