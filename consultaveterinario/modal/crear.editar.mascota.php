<!-- Modal: Crear/Editar mascota -->
<div class="modal fade" id="modal-crear-editar-mascota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-badge"></i> Añadir/Editar Mascota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="row" >

                    <div class="col-12">
                        <form id="form-crear-editar-mascota">
                            <input type="hidden" id="form-crear-editar-mascota-id" name="id" value="0">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-nif" name="nif" placeholder="Nif">
                                        <label for="form-crear-editar-mascota-nif">NIF</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="form-crear-editar-mascota-email" name="email" placeholder="Email">
                                        <label for="form-crear-editar-mascota-email">Email</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-nombreTutor" name="nombreTutor" placeholder="Nombre Tutor">
                                        <label for="form-crear-editar-mascota-nombre-tutor">Nombre Tutor</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="form-crear-editar-mascota-telefonoMovil" name="telefonoMovil" placeholder="Teléfono Móvil">
                                        <label for="form-crear-editar-mascota-telefonoMovil">Teléfono Móvil</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-nombreMascota" name="nombreMascota" placeholder="Nombre Mascota">
                                        <label for="form-crear-editar-mascota-nombreMascota">Nombre Mascota</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="form-crear-editar-mascota-fechaNacimiento" name="fechaNacimiento" placeholder="Fecha Nacimiento">
                                        <label for="form-crear-editar-mascota-fechaNacimiento">Fecha de Nacimiento</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-numeroChip" name="numeroChip" placeholder="Numero chip">
                                        <label for="form-crear-editar-mascota-numeroChip">Numero de Chip</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-especie" name="especie" placeholder="Especie">
                                        <label for="form-crear-editar-mascota-especie">Especie</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-raza" name="raza" placeholder="Raza">
                                        <label for="form-crear-editar-mascota-raza">Raza</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-mascota-sexo" name="sexo" placeholder="Sexo">
                                        <label for="form-crear-editar-mascota-sexo">Sexo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="mb-3">
                                        <span class="badge" id="form-crear-editar-mascota-feedback"></span>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea style="height: 150px" class="form-control" placeholder="Expediente Animal" id="form-crear-editar-mascota-expedienteAnimal" name="expedienteAnimal"></textarea>
                                        <label for="form-crear-editar-mascota-expedienteAnimal">Expediente Animal</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <textarea style="height: 150px" class="form-control" placeholder="Observaciones" id="form-crear-editar-mascota-observaciones" name="observaciones"></textarea>
                                        <label for="form-crear-editar-mascota-observaciones">Observaciones</label>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <textarea style="height: 150px" class="form-control" placeholder="Alergias" id="form-crear-editar-mascota-alergias" name="alergias"></textarea>
                                        <label for="form-crear-editar-mascota-alergias">Alergias</label>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark-subtle">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="guardarMascota(this)"><i class="bi bi-cloud-arrow-up"></i> Guardar Datos</button>
            </div>
        </div>
    </div>
</div>