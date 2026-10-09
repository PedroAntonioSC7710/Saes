<main class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 650px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Editar Calificación</h4>
        </div>

        <div class="card-body">
            <form action="<?= site_url(
                'calificaciones/actualizar/' .
                $calificacion->id_alumn . '/' .
                $calificacion->id_prof . '/' .
                $calificacion->id_mat . '/' .
                $calificacion->id_grup
            ); ?>" method="POST">

                <div class="mb-3">
                    <label class="form-label">Alumno</label>
                    <select class="form-select" disabled>
                        <?php foreach ($alumnos as $a): ?>
                            <?php if ($a->id_alumn == $calificacion->id_alumn): ?>
                                <option selected>
                                    <?= html_escape($a->nombre_al . ' ' . $a->apaterno_al . ' ' . $a->amaterno_al); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Profesor</label>
                    <select class="form-select" disabled>
                        <?php foreach ($profesores as $p): ?>
                            <?php if ($p->id_prof == $calificacion->id_prof): ?>
                                <option selected>
                                    <?= html_escape($p->nombre_prof . ' ' . $p->apellidop_prof . ' ' . $p->apellidom_prof); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Materia</label>
                    <select class="form-select" disabled>
                        <?php foreach ($materias as $m): ?>
                            <?php if ($m->id_mat == $calificacion->id_mat): ?>
                                <option selected>
                                    <?= html_escape($m->descripcion_mat); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grupo</label>
                    <select class="form-select" disabled>
                        <?php foreach ($grupos as $g): ?>
                            <?php if ($g->id_grup == $calificacion->id_grup): ?>
                                <option selected>
                                    <?= html_escape($g->descripcion_grup); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Calificación</label>
                    <input type="number"
                           name="calif"
                           class="form-control"
                           min="0"
                           max="10"
                           step="0.1"
                           value="<?= html_escape($calificacion->calif); ?>"
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Guardar Cambios
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