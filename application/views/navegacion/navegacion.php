<?php
$role = $this->session->userdata('saes_role');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="<?= site_url('inicio'); ?>">
            SAES
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#saesMenu"
                aria-controls="saesMenu"
                aria-expanded="false"
                aria-label="Mostrar menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="saesMenu">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('inicio'); ?>">
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('alumnos/lista'); ?>">
                        Alumnos
                    </a>
                </li>

                <?php if ($role === 'admin' || $role === 'alumno'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('profesores/lista'); ?>">
                            Profesores
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($role === 'admin'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('materias/lista'); ?>">
                            Materias
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('grupos/lista'); ?>">
                            Grupos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('procesos/panel'); ?>">
                            Procesos
                        </a>
                    </li>

                <?php endif; ?>

                <?php if ($role === 'admin' || $role === 'profesor'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('calificaciones/lista'); ?>">
                            Calificaciones
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('calificaciones/masiva'); ?>">
                            Captura masiva
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

            <span class="navbar-text text-white me-3">
                <?= html_escape(ucfirst($role)); ?>
            </span>

            <a class="btn btn-outline-light btn-sm"
               href="<?= site_url('acceso/salir'); ?>">
                Salir
            </a>

        </div>
    </div>
</nav>