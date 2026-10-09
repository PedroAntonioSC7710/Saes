<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="<?= site_url(); ?>">
            <i class="bi bi-mortarboard-fill"></i> SAES
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSAES"
                aria-controls="navbarSAES"
                aria-expanded="false"
                aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSAES">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url(); ?>">
                        Inicio
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">
                        Registro
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="<?= site_url('alumnos/registro'); ?>">
                                Alumnos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('materias/registro'); ?>">
                                Materias
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('profesores/registro'); ?>">
                                Profesores
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('grupos/registro'); ?>">
                                Grupos
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">
                        Proceso
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                               href="<?= site_url('calificaciones/registro'); ?>">
                                Calificaciones
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">
                        Informes
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="<?= site_url('alumnos/lista'); ?>">
                                Alumnos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('materias/lista'); ?>">
                                Materias
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('profesores/lista'); ?>">
                                Profesores
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('grupos/lista'); ?>">
                                Grupos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="<?= site_url('calificaciones/lista'); ?>">
                                Calificaciones
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            <span class="navbar-text text-white">
                Sistema de Administración Escolar
            </span>

        </div>
    </div>
</nav>