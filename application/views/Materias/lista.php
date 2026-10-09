<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-2">
            <i class="bi bi-book-fill"></i> Materias
        </h2>

        <p class="text-muted">Registro y consulta de materias</p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= site_url('materias/registro'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nueva Materia
            </a>

            <a href="<?= site_url('materias/exportar_excel'); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar a Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Materia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($materias)): ?>
                        <?php foreach ($materias as $materia): ?>
                            <tr>
                                <td><?= html_escape($materia->id_mat); ?></td>
                                <td><?= html_escape($materia->descripcion_mat); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('materias/editar/' . $materia->id_mat); ?>"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>

                                        <a href="<?= site_url('materias/eliminar/' . $materia->id_mat); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Dar de baja esta materia?');">
                                            <i class="bi bi-trash-fill"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                No hay materias registradas.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>