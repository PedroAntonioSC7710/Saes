<div class="container py-4">
    <h2 class="mb-4"><?= html_escape($titulo); ?></h2>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger">
            <?= html_escape($error); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <?= isset($registro->{$config['pk']}) ? 'Editar registro' : 'Nuevo registro'; ?>
        </div>

        <div class="card-body">
            <?php
            $accion = 'procesos/guardar/' . $tabla;

            if (isset($registro->{$config['pk']})) {
                $accion .= '/' . $registro->{$config['pk']};
            }
            ?>

            <?= form_open($accion); ?>

                <div class="row">
                    <?php foreach ($config['campos'] as $campo => $etiqueta): ?>
                        <?php $valor = $registro->{$campo} ?? ''; ?>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="<?= html_escape($campo); ?>">
                                <?= html_escape($etiqueta); ?>
                            </label>

                            <?php if ($campo === 'calif'): ?>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="<?= html_escape($campo); ?>"
                                    name="<?= html_escape($campo); ?>"
                                    value="<?= html_escape($valor); ?>"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    placeholder=""
                                    required
                                >
                            <?php elseif ($campo === 'descripcion_uni'): ?>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="<?= html_escape($campo); ?>"
                                    name="<?= html_escape($campo); ?>"
                                    value="<?= html_escape($valor); ?>"
                                    maxlength="2"
                                    required
                                >
                            <?php else: ?>
                                <select
                                    class="form-select"
                                    id="<?= html_escape($campo); ?>"
                                    name="<?= html_escape($campo); ?>"
                                    required
                                >
                                    <option value="">Selecciona una opción</option>

                                    <?php foreach ($opciones[$campo] as $clave => $texto): ?>
                                        <option
                                            value="<?= html_escape($clave); ?>"
                                            <?= (string) $valor === (string) $clave ? 'selected' : ''; ?>
                                        >
                                            <?= html_escape($texto); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>

                <a
                    href="<?= site_url('procesos/lista/' . $tabla); ?>"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

            <?= form_close(); ?>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>

                    <?php foreach ($config['campos'] as $etiqueta): ?>
                        <th><?= html_escape($etiqueta); ?></th>
                    <?php endforeach; ?>

                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($registros)): ?>
                    <tr>
                        <td
                            colspan="<?= count($config['campos']) + 2; ?>"
                            class="text-center"
                        >
                            No hay registros.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($registros as $fila): ?>
                    <tr>
                        <td><?= (int) $fila->{$config['pk']}; ?></td>

                        <?php foreach ($config['campos'] as $campo => $etiqueta): ?>
                            <?php
                            $valor = $fila->{$campo} ?? NULL;

                            if ($campo === 'calif') {
                                $texto = $valor === NULL
                                    ? 'Sin calificación'
                                    : number_format((float) $valor, 2, '.', '');
                            } else {
                                $texto = isset($opciones[$campo])
                                    ? ($opciones[$campo][$valor] ?? $valor)
                                    : $valor;
                            }
                            ?>

                            <td><?= html_escape((string) $texto); ?></td>
                        <?php endforeach; ?>

                        <td class="text-nowrap">
                            <a
                                class="btn btn-warning btn-sm"
                                href="<?= site_url(
                                    'procesos/editar/' . $tabla . '/' . $fila->{$config['pk']}
                                ); ?>"
                            >
                                Editar
                            </a>

                            <?= form_open(
                                'procesos/eliminar/' . $tabla . '/' . $fila->{$config['pk']},
                                array(
                                    'class' => 'd-inline',
                                    'onsubmit' => "return confirm('¿Confirmas esta operación?');"
                                )
                            ); ?>

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <?= $tabla === 'inscripciongrup' ? 'Dar de baja' : 'Eliminar'; ?>
                                </button>

                            <?= form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>