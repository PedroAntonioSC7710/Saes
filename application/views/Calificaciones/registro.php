<main class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registro de Calificaciones</h4>
        </div>

        <div class="card-body">
            <form action="<?= site_url('calificaciones/guardar'); ?>" method="POST">

                <div class="mb-3">
                    <label class="form-label">Alumno</label>
                    <select name="id_alumn" class="form-select" required>
                        <option value="">Seleccione un alumno</option>
                        <?php foreach ($alumnos as $a): ?>
                            <option value="<?= (int) $a->id_alumn; ?>">
                                <?= html_escape($a->matricula_al . ' - ' . $a->nombre_al . ' ' . $a->apaterno_al . ' ' . $a->amaterno_al); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Profesor</label>
                    <select name="id_prof" class="form-select" required>
                        <option value="">Seleccione un profesor</option>
                        <?php foreach ($profesores as $p): ?>
                            <option value="<?= (int) $p->id_prof; ?>">
                                <?= html_escape($p->nombre_prof . ' ' . $p->apellidop_prof . ' ' . $p->apellidom_prof); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Materia</label>
                    <select name="id_mat" class="form-select" required>
                        <option value="">Seleccione una materia</option>
                        <?php foreach ($materias as $m): ?>
                            <option value="<?= (int) $m->id_mat; ?>">
                                <?= html_escape($m->descripcion_mat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grupo</label>
                    <select name="id_grup" class="form-select" required>
                        <option value="">Seleccione un grupo</option>
                        <?php foreach ($grupos as $g): ?>
                            <option value="<?= (int) $g->id_grup; ?>">
                                <?= html_escape($g->descripcion_grup); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Calificación</label>
                    <input type="number" name="calif" class="form-control"
                           min="0" max="10" step="0.1" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Guardar Calificación
                    </button>

                    <a href="<?= site_url('calificaciones/lista'); ?>"
                       class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</main>