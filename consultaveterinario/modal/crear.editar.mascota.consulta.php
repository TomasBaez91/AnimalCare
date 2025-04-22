<?php
require_once __DIR__ . '/../../class/class.Usuario.php';
$veterinarios = listadoUsuarios(['id','apellidos','nombre'], 'VETERINARIO');

$opcionesSelectVeterinarios = '';
foreach($veterinarios as $veterinario) {
    $opcionesSelectVeterinarios .= '<option value="'.$veterinario['id'].'">'.$veterinario['apellidos'].', '.$veterinario['nombre'].'</option>';
}
?>

<!-- Modal: Crear/Editar Consulta Mascota -->
<div class="modal fade" id="modal-crear-editar-consulta-mascota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-clipboard-plus"></i> Añadir/Editar Consulta Mascota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="form-crear-editar-consulta-mascota">
                            <input type="hidden" id="form-crear-editar-consulta-mascota-id" name="id" value="0">
                            <div class="row">
                                <div class="row">
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" value="" id="form-crear-editar-consulta-mascota-fechaHora" name="fechaHora" placeholder="Fecha Hora">
                                            <label for="form-crear-editar-consulta-mascota-fechaHora">Fecha Hora</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <div class="form-floating">
                                            <select class="form-select" id="form-crear-editar-consulta-mascota-idVeterinario" name="idVeterinario" aria-label="Floating label select example">
                                                <option value="0" selected>Seleccione un Veterinario</option>
                                                <?php echo $opcionesSelectVeterinarios; ?>
                                            </select>
                                            <label for="form-crear-editar-consulta-mascota-idVeterinario">Seleccionar Veterinario</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="mb-3">
                                        <span class="badge" id="form-crear-editar-consulta-mascota-feedback"></span>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea style="height: 150px" class="form-control" placeholder="Motivo Consulta" id="form-crear-editar-consulta-mascota-motivoConsulta" name="motivoConsulta"></textarea>
                                        <label for="form-crear-editar-consulta-mascota-motivoConsulta">Motivo Consulta</label>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark-subtle">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="guardarConsultaMascota(this)"><i class="bi bi-cloud-arrow-up"></i> Guardar Datos</button>
            </div>
        </div>
    </div>
</div>