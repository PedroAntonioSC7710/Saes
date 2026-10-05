<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alumnos - SAES</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            background-color: #f5f6f8;
        }

        .barra-superior {
            background-color: #164d80;
            color: white;
            padding: 18px 30px;
        }

        .barra-superior h2 {
            margin: 0;
            font-weight: bold;
        }

        .menu {
            min-height: calc(100vh - 76px);
            background-color: #eeeeee;
            padding: 20px 0;
        }

        .menu a {
            display: block;
            padding: 15px 25px;
            color: #222;
            text-decoration: none;
            font-size: 17px;
        }

        .menu a:hover {
            background-color: #dddddd;
        }

        .menu .activo {
            background-color: #0d6efd;
            color: white;
        }

        .contenido {
            padding: 30px;
        }

        .encabezado-alumnos {
            background-color: #e7f1ff;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .encabezado-alumnos h1 {
            color: #123d69;
            font-weight: bold;
            margin: 0;
        }

        .tabla-alumnos {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
        }
    </style>
</head>

<body>

<div class="barra-superior d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-4">

        <h2>
            <i class="bi bi-mortarboard-fill"></i>
            SAES
        </h2>

        <span>Sistema de Administración Escolar</span>

    </div>

    <div>
        <i class="bi bi-person-circle"></i>
        Administrador
    </div>

</div>


<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 menu">

            <a href="<?= base_url(); ?>">
                <i class="bi bi-house-door-fill"></i>
                Inicio
            </a>

            <a href="<?= site_url('alumnos/lista'); ?>"
               class="activo">

                <i class="bi bi-people-fill"></i>
                Alumnos

            </a>

            <a href="<?= site_url('materias/lista'); ?>">

                <i class="bi bi-book-fill"></i>
                Materias

            </a>

            <a href="<?= site_url('profesores/lista'); ?>">

                <i class="bi bi-person-badge-fill"></i>
                Profesores

            </a>

            <a href="#">

                <i class="bi bi-calculator-fill"></i>
                Calificaciones

            </a>

            <a href="#">

                <i class="bi bi-box-arrow-right"></i>
                Cerrar sesión

            </a>

        </div>


        <div class="col-md-10 contenido">

            <div class="encabezado-alumnos">

                <h1>Alumnos</h1>

                <p class="mb-0">
                    Registro y consulta de alumnos
                </p>

            </div>



            <a href="<?= site_url('alumnos/registro'); ?>"
               class="btn btn-primary mb-3">

                <i class="bi bi-plus-lg"></i>
                Nuevo Alumno

            </a>

            <a href="<?= site_url('alumnos/exportar_excel'); ?>"
                class="btn btn-success mb-3">

                <i class="bi bi-file-earmark-excel-fill"></i>
                Exportar a Excel

            </a>

            <div class="tabla-alumnos">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (!empty($alumnos)): ?>

                        <?php foreach ($alumnos as $alumno): ?>

                            <tr>

                                <td>
                                    <?= $alumno->id_alumn; ?>
                                </td>

                                <td>
                                    <?= $alumno->matricula_al; ?>
                                </td>

                                <td>
                                    <?= $alumno->nombre_al; ?>
                                </td>

                                <td>
                                    <?= $alumno->apaterno_al; ?>
                                </td>

                                <td>
                                    <?= $alumno->amaterno_al; ?>
                                </td>

                                <td>
                                    <?= $alumno->tel_al; ?>
                                </td>

                                <td>
                                    <?= $alumno->dom_al; ?>
                                </td>
                                
                                <td>

                                    <a href="<?= site_url('alumnos/editar/' . $alumno->id_alumn); ?>"
                                       class="btn btn-primary btn-sm">

                                        <i class="bi bi-pencil-fill"></i>
                                        Editar

                                    </a>


                                    <a href="<?= site_url('alumnos/eliminar/' . $alumno->id_alumn); ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Estás seguro de dar de baja a este alumno?');">

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

                                No hay alumnos registrados.

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