<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-2">
            <i class="bi bi-person-badge-fill"></i> Profesores
        </h2>

        <p class="text-muted">Registro y consulta de profesores</p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= site_url('profesores/registro'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nuevo Profesor
            </a>

            <a href="<?= site_url('profesores/exportar_excel'); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar a Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>No. Control</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Teléfono</th>
                        <th>Domicilio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($profesores)): ?>
                        <?php foreach ($profesores as $profesor): ?>
                            <tr>
                                <td><?= html_escape($profesor->id_prof); ?></td>
                                <td><?= html_escape($profesor->nocontrol_prof); ?></td>
                                <td><?= html_escape($profesor->nombre_prof); ?></td>
                                <td><?= html_escape($profesor->apellidop_prof); ?></td>
                                <td><?= html_escape($profesor->apellidom_prof); ?></td>
                                <td><?= html_escape($profesor->tel_prof); ?></td>
                                <td><?= html_escape($profesor->dom_prof); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('profesores/editar/' . $profesor->id_prof); ?>"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>

                                        <a href="<?= site_url('profesores/eliminar/' . $profesor->id_prof); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Dar de baja a este profesor?');">
                                            <i class="bi bi-trash-fill"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No hay profesores registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>