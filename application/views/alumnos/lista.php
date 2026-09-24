<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos - SAES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        }
    </style>
</head>

<body>

<div class="barra-superior d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-4">
        <h2>
            SAES
        </h2>

        <span>Sistema de Administración Escolar</span>
    </div>

    <div>
        Administrador
    </div>

</div>


<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 menu">

            <a href="#">
                Inicio
            </a>

            <a href="#" class="activo">
                Alumnos
            </a>

            <a href="#">
                Materias
            </a>

            <a href="#">
                Profesores
            </a>

            <a href="#">
                Calificaciones
            </a>

            <a href="#">
                Cerrar sesión
            </a>

        </div>

        <div class="col-md-10 contenido">

            <div class="encabezado-alumnos">

                <h1>
                    Alumnos
                </h1>

                <p class="mb-0">
                    Registro y consulta de alumnos
                </p>

            </div>

            <a href="#" class="btn btn-primary mb-3">

                <i class="bi bi-plus-lg"></i>
                Nuevo Alumno
            </a>

            <div class="tabla-alumnos">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>231250147</td>
                            <td>Pedro Antonio</td>
                            <td>Sánchez</td>
                            <td>ITICs</td>
                            <td>6</td>

                            <td>

                                <button class="btn btn-primary btn-sm">
                                    Editar
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>

                            </td>
                        </tr>


                        <tr>
                            <td>2</td>
                            <td>231250148</td>
                            <td>Ana Sofía</td>
                            <td>López</td>
                            <td>ITICs</td>
                            <td>4</td>

                            <td>

                                <button class="btn btn-primary btn-sm">
                                    Editar
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>

                            </td>
                        </tr>


                        <tr>
                            <td>3</td>
                            <td>231250149</td>
                            <td>Luis Fernando</td>
                            <td>Ramírez</td>
                            <td>Arquitectura</td>
                            <td>6</td>

                            <td>

                                <button class="btn btn-primary btn-sm">
                                    Editar
                                </button>

                                <button class="btn btn-danger btn-sm">
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