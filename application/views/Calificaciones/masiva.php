<?php
$esProfesor = $role === 'profesor';
$bloqueado = $esProfesor && $confirmado;
$seleccionCompleta = !empty($seleccion['id_prof']) &&
                     !empty($seleccion['id_mat']) &&
                     !empty($seleccion['id_grup']);
?>

<div class="container-fluid py-4 px-3 px-lg-5">

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Captura Masiva de Calificaciones</h4>
        </div>

        <div class="card-body">

            <form action="<?= site_url('calificaciones/masiva'); ?>" method="get">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Profesor</label>

                        <select name="id_prof" class="form-select" required>
                            <option value="">Seleccione un profesor</option>

                            <?php foreach ($profesores as $p): ?>
                                <option
                                    value="<?= (int) $p->id_prof; ?>"
                                    <?= (int) $seleccion['id_prof'] === (int) $p->id_prof ? 'selected' : ''; ?>
                                >
                                    <?= html_escape($p->nombre_prof . ' ' . $p->apellidop_prof . ' ' . $p->apellidom_prof); ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Materia</label>

                        <select name="id_mat" class="form-select" required>
                            <option value="">Seleccione una materia</option>

                            <?php foreach ($materias as $m): ?>
                                <option
                                    value="<?= (int) $m->id_mat; ?>"
                                    <?= (int) $seleccion['id_mat'] === (int) $m->id_mat ? 'selected' : ''; ?>
                                >
                                    <?= html_escape($m->descripcion_mat); ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Grupo</label>

                        <select name="id_grup" class="form-select" required>
                            <option value="">Seleccione un grupo</option>

                            <?php foreach ($grupos as $g): ?>
                                <option
                                    value="<?= (int) $g->id_grup; ?>"
                                    <?= (int) $seleccion['id_grup'] === (int) $g->id_grup ? 'selected' : ''; ?>
                                >
                                    <?= html_escape($g->descripcion_grup); ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Mostrar alumnos
                    </button>
                </div>

            </form>

        </div>
    </div>

    <?php if ($seleccionCompleta): ?>

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Alumnos</h5>

                <?php if ($confirmado): ?>
                    <span class="badge bg-success">
                        Calificaciones confirmadas
                    </span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark">
                        Pendiente de confirmar
                    </span>
                <?php endif; ?>
            </div>

            <div class="card-body">

                <?php if ($bloqueado): ?>
                    <div class="alert alert-info">
                        Estas calificaciones ya fueron confirmadas.
                        Solamente el administrador puede modificarlas.
                    </div>
                <?php endif; ?>

                <form
                    action="<?= site_url('calificaciones/guardar_masiva'); ?>"
                    method="post"
                >

                    <input type="hidden" name="id_prof" value="<?= (int) $seleccion['id_prof']; ?>">
                    <input type="hidden" name="id_mat" value="<?= (int) $seleccion['id_mat']; ?>">
                    <input type="hidden" name="id_grup" value="<?= (int) $seleccion['id_grup']; ?>">

                    <?php if ($this->config->item('csrf_protection')): ?>
                        <input
                            type="hidden"
                            name="<?= html_escape($this->security->get_csrf_token_name()); ?>"
                            value="<?= html_escape($this->security->get_csrf_hash()); ?>"
                        >
                    <?php endif; ?>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Matrícula</th>
                                    <th>Nombre completo</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($filas as $indice => $alumno): ?>

                                    <tr>
                                        <td><?= $indice + 1; ?></td>

                                        <td>
                                            <?= html_escape($alumno->matricula_al); ?>
                                        </td>

                                        <td>
                                            <?= html_escape(
                                                $alumno->nombre_al . ' ' .
                                                $alumno->apaterno_al . ' ' .
                                                $alumno->amaterno_al
                                            ); ?>
                                        </td>

                                        <td style="max-width: 160px;">
                                            <input
                                                type="number"
                                                name="calif[<?= (int) $alumno->id_alumn; ?>]"
                                                class="form-control"
                                                min="0"
                                                max="10"
                                                step="0.01"
                                                value="<?= $alumno->calif !== null ? html_escape($alumno->calif) : ''; ?>"
                                                <?= $bloqueado ? 'disabled' : ''; ?>
                                                required
                                            >
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                <?php if (empty($filas)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No hay alumnos disponibles.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                    <?php if (!$bloqueado && !empty($filas)): ?>

                        <button type="submit" class="btn btn-success">
                            Guardar calificaciones
                        </button>

                    <?php endif; ?>

                </form>

                <?php if (!$confirmado && !empty($filas)): ?>

                    <form
                        action="<?= site_url('calificaciones/confirmar_masiva'); ?>"
                        method="post"
                        class="mt-3"
                        onsubmit="return confirm('¿Confirmar las calificaciones? Después de confirmar, el profesor ya no podrá modificarlas.');"
                    >

                        <input type="hidden" name="id_prof" value="<?= (int) $seleccion['id_prof']; ?>">
                        <input type="hidden" name="id_mat" value="<?= (int) $seleccion['id_mat']; ?>">
                        <input type="hidden" name="id_grup" value="<?= (int) $seleccion['id_grup']; ?>">

                        <?php if ($this->config->item('csrf_protection')): ?>
                            <input
                                type="hidden"
                                name="<?= html_escape($this->security->get_csrf_token_name()); ?>"
                                value="<?= html_escape($this->security->get_csrf_hash()); ?>"
                            >
                        <?php endif; ?>

                        <button type="submit" class="btn btn-warning">
                            Confirmar calificaciones
                        </button>

                    </form>

                <?php endif; ?>

            </div>

        </div>

    <?php endif; ?>

</div>