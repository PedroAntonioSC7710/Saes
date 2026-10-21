<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">
        <h2 class="text-primary mb-4">Consulta de Alumnos</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Domicilio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $a): ?>
                        <tr>
                            <td><?= html_escape($a->matricula_al); ?></td>
                            <td><?= html_escape($a->nombre_al); ?></td>
                            <td><?= html_escape($a->apaterno_al . ' ' . $a->amaterno_al); ?></td>
                            <td><?= html_escape($a->tel_al); ?></td>
                            <td><?= html_escape($a->dom_al); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($alumnos)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay alumnos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>