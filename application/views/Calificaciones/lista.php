<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-3">
            <i class="bi bi-clipboard-check-fill"></i>
            Calificaciones
        </h2>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= site_url('calificaciones/registro'); ?>"
               class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Nueva Calificación
            </a>

            <a href="<?= site_url('calificaciones/exportar_excel'); ?>"
               class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i>
                Exportar a Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Matrícula</th>
                        <th>Alumno</th>
                        <th>Profesor</th>
                        <th>Materia</th>
                        <th>Grupo</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($calificaciones)): ?>
                        <?php foreach ($calificaciones as $c): ?>
                            <tr>
                                <td><?= html_escape($c->matricula_al); ?></td>

                                <td>
                                    <?= html_escape($c->nombre_al . ' ' . $c->apaterno_al . ' ' . $c->amaterno_al); ?>
                                </td>

                                <td>
                                    <?= html_escape($c->nombre_prof . ' ' . $c->apellidop_prof . ' ' . $c->apellidom_prof); ?>
                                </td>

                                <td><?= html_escape($c->descripcion_mat); ?></td>
                                <td><?= html_escape($c->descripcion_grup); ?></td>
                                <td><?= html_escape($c->calif); ?></td>

                                <td>
                                    <a href="<?= site_url(
                                        'calificaciones/editar/' .
                                        $c->id_alumn . '/' .
                                        $c->id_prof . '/' .
                                        $c->id_mat . '/' .
                                        $c->id_grup
                                    ); ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                No hay calificaciones registradas.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>