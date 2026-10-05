<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profesores | SAES</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background: #f5f6f8;
        }

        .barra {
            background: #174f80;
            color: white;
            padding: 18px 30px;
        }

        .barra h2 {
            margin: 0;
        }

        .menu {
            background: #eeeeee;
            min-height: calc(100vh - 75px);
            padding: 20px 0;
        }

        .menu a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            color: #222;
        }

        .menu a:hover {
            background: #dddddd;
        }

        .menu .activo {
            background: #0d6efd;
            color: white;
        }

        .contenido {
            padding: 30px;
        }

        .titulo {
            background: #e7f1ff;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .titulo h1 {
            color: #174f80;
            font-weight: bold;
        }

        .tabla {
            background: white;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
        }

    </style>

</head>


<body>

<div class="barra d-flex justify-content-between">

    <h2>
        <i class="bi bi-mortarboard-fill"></i>
        SAES
    </h2>

    <span>
        <i class="bi bi-person-circle"></i>
        Administrador
    </span>

</div>


<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 menu">

            <a href="<?= base_url(); ?>">
                <i class="bi bi-house-door-fill me-2"></i>
                Inicio
            </a>

            <a href="<?= site_url('alumnos/lista'); ?>">
                <i class="bi bi-people-fill me-2"></i>
                Alumnos
            </a>

            <a href="<?= site_url('materias/lista'); ?>">
                <i class="bi bi-book-fill me-2"></i>
                Materias
            </a>

            <a href="<?= site_url('profesores/lista'); ?>"
               class="activo">

                <i class="bi bi-person-fill me-2"></i>
                Profesores

            </a>

            <a href="#">
                <i class="bi bi-calculator-fill me-2"></i>
                Calificaciones
            </a>

            <a href="#">
                <i class="bi bi-box-arrow-right me-2"></i>
                Cerrar sesión
            </a>

        </div>

        <div class="col-md-10 contenido">

            <div class="titulo">

                <h1>
                    <i class="bi bi-person-fill"></i>
                    Profesores
                </h1>

                <p class="mb-0">
                    Registro y consulta de profesores
                </p>

            </div>

            <a href="<?= site_url('profesores/registro'); ?>"
               class="btn btn-primary mb-3">

                <i class="bi bi-plus-lg"></i>
                Nuevo Profesor

            </a>

            <a href="<?= site_url('profesores/exportar_excel'); ?>"
                class="btn btn-success mb-3">

            <i class="bi bi-file-earmark-excel-fill"></i>
                Exportar a Excel

            </a>

            <div class="tabla">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (!empty($profesores)): ?>

                        <?php foreach ($profesores as $profesor): ?>

                            <tr>

                                <td>
                                    <?= $profesor->id_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->nocontrol_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->nombre_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->apellidop_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->apellidom_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->tel_prof; ?>
                                </td>

                                <td>
                                    <?= $profesor->dom_prof; ?>
                                </td>

                                <td>

                                    <a href="<?= site_url('profesores/editar/' . $profesor->id_prof); ?>"
                                       class="btn btn-primary btn-sm">

                                        <i class="bi bi-pencil-fill"></i>
                                        Editar

                                    </a>


                                    <a href="<?= site_url('profesores/eliminar/' . $profesor->id_prof); ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Estás seguro de eliminar este profesor?');">

                                        <i class="bi bi-trash-fill"></i>
                                        Eliminar

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <tr>

                            <td colspan="9"
                                class="text-center">

                                No hay profesores registrados.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


</body>

</html>