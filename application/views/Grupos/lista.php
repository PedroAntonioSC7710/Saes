<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Grupos - SAES</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container-fluid">

        <span class="navbar-brand mb-0 h1">
            SAES - Sistema de Administración Escolar
        </span>

    </div>

</nav>


<div class="container mt-4">

    <h2>Grupos</h2>

    <hr>


    <a href="<?= site_url('grupos/registro'); ?>"
       class="btn btn-primary mb-3">

        <i class="bi bi-plus-lg"></i>
        Nuevo Grupo

    </a>


    <a href="<?= site_url('grupos/exportar_excel'); ?>"
       class="btn btn-success mb-3">

        <i class="bi bi-file-earmark-excel-fill"></i>
        Exportar a Excel

    </a>


    <a href="<?= site_url('alumnos/lista'); ?>"
       class="btn btn-secondary mb-3">

        Alumnos

    </a>


    <a href="<?= site_url('materias/lista'); ?>"
       class="btn btn-secondary mb-3">

        Materias

    </a>


    <a href="<?= site_url('profesores/lista'); ?>"
       class="btn btn-secondary mb-3">

        Profesores

    </a>


    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Grupo</th>
                <th>Estatus</th>
                <th>Acciones</th>

            </tr>

        </thead>


        <tbody>

            <?php foreach ($grupos as $grupo): ?>

                <tr>

                    <td>
                        <?= $grupo->id_grup; ?>
                    </td>

                    <td>
                        <?= $grupo->descripcion_grup; ?>
                    </td>

                    <td>
                        <?= $grupo->estatus_grup; ?>
                    </td>

                    <td>

                        <a href="<?= site_url('grupos/editar/' . $grupo->id_grup); ?>"
                           class="btn btn-primary btn-sm">

                            <i class="bi bi-pencil-fill"></i>
                            Editar

                        </a>


                        <a href="<?= site_url('grupos/eliminar/' . $grupo->id_grup); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de eliminar este grupo?');">

                            <i class="bi bi-trash-fill"></i>
                            Eliminar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>

</html>