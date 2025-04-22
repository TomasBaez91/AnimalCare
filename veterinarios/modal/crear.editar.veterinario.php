<!-- Modal: Crear/Editar veterinario -->
<div class="modal fade" id="modal-crear-editar-veterinario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-thermometer"></i> Añadir/Editar Veterinario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="form-crear-editar-veterinario">
                            <input type="hidden" id="form-crear-editar-veterinario-id" name="id" value="0">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-veterinario-nombre" name="nombre" placeholder="Nombre">
                                        <label for="form-crear-editar-veterinario-nombre">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="form-crear-editar-veterinario-apellidos" name="apellidos" placeholder="Apellidos">
                                        <label for="form-crear-editar-veterinario-apellidos">Apellidos</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="form-crear-editar-veterinario-email" name="email" placeholder="Email">
                                        <label for="form-crear-editar-veterinario-email">Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="form-crear-editar-veterinario-password1" name="password1" placeholder="Contraseña">
                                        <label for="form-crear-editar-veterinario-password1">Contraseña</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="form-crear-editar-veterinario-password2" name="password2" placeholder="Repetir Contraseña">
                                        <label for="form-crear-editar-veterinario-password2">Repetir Contraseña</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="form-crear-editar-veterinario-bloqueado" name="bloqueado">
                                        <label class="form-check-label" for="form-crear-editar-veterinario-bloqueado">Bloqueado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="mb-3">
                                        <span class="badge" id="form-crear-editar-veterinario-feedback"></span>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark-subtle">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="guardarVeterinario(this)"><i class="bi bi-cloud-arrow-up"></i> Guardar Datos</button>
            </div>
        </div>
    </div>
</div>