<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">
        <h2 class="text-primary mb-4">Consulta de Profesores</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Número de control</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Domicilio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($profesores as $p): ?>
                        <tr>
                            <td><?= html_escape($p->nocontrol_prof); ?></td>
                            <td><?= html_escape($p->nombre_prof); ?></td>
                            <td><?= html_escape($p->apellidop_prof . ' ' . $p->apellidom_prof); ?></td>
                            <td><?= html_escape($p->tel_prof); ?></td>
                            <td><?= html_escape($p->dom_prof); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($profesores)): ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay profesores registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>