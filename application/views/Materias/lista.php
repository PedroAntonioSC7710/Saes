<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Materias | SAES</title>

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
            background: #ddd;
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

        <a href="#">
            <i class="bi bi-house-door-fill me-2"></i>
            Inicio
        </a>

        <a href="<?= site_url('alumnos/lista'); ?>">
            <i class="bi bi-people-fill me-2"></i>
            Alumnos
        </a>

        <a href="<?= site_url('materias/lista'); ?>" class="activo">
            <i class="bi bi-book-fill me-2"></i>
            Materias
        </a>

        <a href="<?= site_url('profesores/lista'); ?>">
            <i class="bi bi-person-fill me-2"></i>
            Profesores
        </a>

        <a href="#">
            <i class="bi bi-calculator-fill me-2"></i>
            Calificaciones
        </a>

    </div>

    <div class="col-md-10 contenido">

        <div class="titulo">

            <h1>
                <i class="bi bi-book-fill"></i>
                Materias
            </h1>

            <p class="mb-0">
                Registro y consulta de materias
            </p>

        </div>

        <button class="btn btn-primary mb-3">

            <i class="bi bi-plus-lg"></i>
            Nueva Materia

        </button>

        <div class="tabla">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Clave</th>
                        <th>Materia</th>
                        <th>Semestre</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>TIC-601</td>
                        <td>Programación</td>
                        <td>6</td>

                        <td>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                                Editar
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                                Eliminar
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>TIC-602</td>
                        <td>Base de Datos</td>
                        <td>6</td>

                        <td>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                                Editar
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                                Eliminar
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>TIC-603</td>
                        <td>Redes</td>
                        <td>6</td>

                        <td>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                                Editar
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                                Eliminar
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

</body>
</html>