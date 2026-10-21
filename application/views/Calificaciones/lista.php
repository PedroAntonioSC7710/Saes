<?php
$rol = $this->session->userdata('saes_role');
$esAdmin = $rol === 'admin';
$esProfesor = $rol === 'profesor';
?>

<main class="container-fluid py-4 px-3 px-lg-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h2 class="text-primary mb-3">
            <i class="bi bi-clipboard-check-fill"></i>
            Calificaciones
        </h2>

        <div class="d-flex flex-wrap gap-2 mb-4">

            <?php if ($esAdmin || $esProfesor): ?>
                <a href="<?= site_url('calificaciones/registro'); ?>"
                   class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Nueva Calificación
                </a>

                <a href="<?= site_url('calificaciones/masiva'); ?>"
                   class="btn btn-info text-white">
                    <i class="bi bi-people-fill"></i>
                    Captura masiva
                </a>
            <?php endif; ?>

            <?php if ($esAdmin): ?>
                <a href="<?= site_url('calificaciones/exportar_excel'); ?>"
                   class="btn btn-success">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Exportar a Excel
                </a>
            <?php endif; ?>

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
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($calificaciones)): ?>

                        <?php foreach ($calificaciones as $c): ?>

                            <?php
                            $confirmada = $this->saes_grades->confirmed(
                                $c->id_prof,
                                $c->id_mat,
                                $c->id_grup
                            );

                            $puedeEditar = $esAdmin || ($esProfesor && !$confirmada);
                            ?>

                            <tr>

                                <td>
                                    <?= html_escape($c->matricula_al); ?>
                                </td>

                                <td>
                                    <?= html_escape(
                                        $c->nombre_al . ' ' .
                                        $c->apaterno_al . ' ' .
                                        $c->amaterno_al
                                    ); ?>
                                </td>

                                <td>
                                    <?= html_escape(
                                        $c->nombre_prof . ' ' .
                                        $c->apellidop_prof . ' ' .
                                        $c->apellidom_prof
                                    ); ?>
                                </td>

                                <td>
                                    <?= html_escape($c->descripcion_mat); ?>
                                </td>

                                <td>
                                    <?= html_escape($c->descripcion_grup); ?>
                                </td>

                                <td>
                                    <?= html_escape($c->calif); ?>
                                </td>

                                <td>
                                    <?php if ($confirmada): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Confirmada
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock-fill"></i>
                                            Pendiente
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($puedeEditar): ?>

                                        <a href="<?= site_url(
                                            'calificaciones/editar/' .
                                            (int) $c->id_alumn . '/' .
                                            (int) $c->id_prof . '/' .
                                            (int) $c->id_mat . '/' .
                                            (int) $c->id_grup
                                        ); ?>"
                                           class="btn btn-primary btn-sm">

                                            <i class="bi bi-pencil-fill"></i>
                                            Editar

                                        </a>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            <i class="bi bi-lock-fill"></i>
                                            Bloqueada
                                        </span>

                                    <?php endif; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="8" class="text-center">
                                No hay calificaciones registradas.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>
</main>