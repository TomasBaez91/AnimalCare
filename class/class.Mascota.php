<?php
require_once __DIR__ . '/../config/config.globales.php';
require_once __DIR__ . '/../db/class.HandlerDB.php';
require_once __DIR__ . '/function.globales.php';
require_once __DIR__ . '/abstract.class.ObjetoDB.php';

class Mascota extends ObjetoDB {
    protected int $id = 0;
    protected string | null $nombreTutor = "";
    protected int $telefonoMovil = 0;
    protected string | null $email = "";
    protected string $nif = "";
    protected int $numeroChip = 0;
    protected string $nombreMascota = "";
    protected string | null $fechaNacimiento = "";


    protected string $especie = "";
    protected string $raza = "";
    protected string $sexo = "";
    protected string $expedienteAnimal = "";
    protected string $observaciones = "";
    protected string $alergias = "";


    public function __construct(int $id = 0, string $otraClave = "", $valorOtraClave = "") {
        parent::__construct($id, $otraClave, $valorOtraClave);
    }

    public function getId(): int {
        return $this->id;
    }
    public function getNombreTutor(): string {
        return sanitizarString($this->nombreTutor);
    }

    public function setNombreTutor($nombreTutor): void {
        $this->nombreTutor = sanitizarString($nombreTutor);
    }
    public function getTelefonoMovil(): int {
        return $this->telefonoMovil;
    }

    public function setTelefonoMovil(int $telefonoMovil): void {
        $this->telefonoMovil = $telefonoMovil;
    }
    public function getEmail(): string | null {
        return sanitizarString($this->email);
    }

    public function setEmail(string | null $email): bool {
        if ($email == "") {
            $this->email = null;
            return true;
        }

        if (validarEmail($email)) {
            $this->email = $email;
            return true;
        }
        return false;
    }
    public function getNif(): string | null {
        return $this->nif;
    }

    public function setNif(string | null $nif): bool {
        if ($nif == "") {
            $this->nif = null;
            return true;
        }
        $this->nif = $nif;
        return true;
    }
    public function getNumeroChip(): int {
        return $this->numeroChip;
    }
    public function setNumeroChip($numeroChip): void {
        $this->numeroChip = $numeroChip;
    }
    public function getNombreMascota(): string {
        return sanitizarString($this->nombreMascota);
    }

    public function setNombreMascota($nombreMascota): void {
        $this->nombreMascota = sanitizarString($nombreMascota);
    }
    public function getFechaNacimiento(bool $formateada = false): string | null {
        if (is_null($this->fechaNacimiento)) {
            return null;
        }

        if ($formateada) {
            return date('d/m/Y', strtotime($this->fechaNacimiento));
        }

        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string | null $fechaNacimiento): void {
        if ($fechaNacimiento == "") {
            $this->fechaNacimiento = null;
        } else {
            $this->fechaNacimiento = $fechaNacimiento;
        }
    }
    public function getEspecie(): string {
        return sanitizarString($this->especie);
    }

    public function setEspecie(string $especie): void {
        $this->especie = sanitizarString($especie);
    }
    public function getRaza(): string {
        return sanitizarString($this->raza);
    }

    public function setRaza(string $raza): void {
        $this->raza = sanitizarString($raza);
    }
    public function getSexo(): string {
        return sanitizarString($this->sexo);
    }

    public function setSexo(string $sexo): void {
        $this->sexo = sanitizarString($sexo);
    }



    public function getExpedienteAnimal(): string {
        return $this->expedienteAnimal;
    }

    public function setExpedienteAnimal(string $expedienteAnimal): void {
        $this->expedienteAnimal = sanitizarString($expedienteAnimal);
    }

    public function getObservaciones(): string {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void {
        $this->observaciones = sanitizarString($observaciones);
    }

    public function getAlergias(): string {
        return $this->alergias;
    }

    public function setAlergias(string $alergias): void {
        $this->alergias = sanitizarString($alergias);
    }

    public function guardar(): bool {
        if ($this->nombreMascota == "" || $this->nombreTutor == "" || $this->telefonoMovil == "") {
            return false;
        }

        return parent::guardar();
    }
}
?>