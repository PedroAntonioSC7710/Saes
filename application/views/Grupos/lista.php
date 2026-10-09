<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-2">
            <i class="bi bi-collection-fill"></i> Grupos
        </h2>

        <p class="text-muted">Registro y consulta de grupos</p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= site_url('grupos/registro'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nuevo Grupo
            </a>

            <a href="<?= site_url('grupos/exportar_excel'); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar a Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($grupos)): ?>
                        <?php foreach ($grupos as $grupo): ?>
                            <tr>
                                <td><?= html_escape($grupo->id_grup); ?></td>
                                <td><?= html_escape($grupo->descripcion_grup); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('grupos/editar/' . $grupo->id_grup); ?>"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>

                                        <a href="<?= site_url('grupos/eliminar/' . $grupo->id_grup); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Dar de baja a este grupo?');">
                                            <i class="bi bi-trash-fill"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                No hay grupos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>