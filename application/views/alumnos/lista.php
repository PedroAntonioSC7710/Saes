<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-2">
            <i class="bi bi-people-fill"></i> Alumnos
        </h2>

        <p class="text-muted">Registro y consulta de alumnos</p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= site_url('alumnos/registro'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nuevo Alumno
            </a>

            <a href="<?= site_url('alumnos/exportar_excel'); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar a Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Teléfono</th>
                        <th>Domicilio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($alumnos)): ?>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?= html_escape($alumno->id_alumn); ?></td>
                                <td><?= html_escape($alumno->matricula_al); ?></td>
                                <td><?= html_escape($alumno->nombre_al); ?></td>
                                <td><?= html_escape($alumno->apaterno_al); ?></td>
                                <td><?= html_escape($alumno->amaterno_al); ?></td>
                                <td><?= html_escape($alumno->tel_al); ?></td>
                                <td><?= html_escape($alumno->dom_al); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('alumnos/editar/' . $alumno->id_alumn); ?>"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>

                                        <a href="<?= site_url('alumnos/eliminar/' . $alumno->id_alumn); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Dar de baja a este alumno?');">
                                            <i class="bi bi-trash-fill"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No hay alumnos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>