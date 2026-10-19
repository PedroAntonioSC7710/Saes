<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= site_url(); ?>">
            <i class="bi bi-mortarboard-fill"></i> SAES
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSAES"
            aria-controls="navbarSAES"
            aria-expanded="false"
            aria-label="Abrir menú"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSAES">
            <ul class="navbar-nav me-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Registro
                    </a>

                    <ul class="dropdown-menu">
                        <?php
                        $registros = array(
                            'alumnos/lista' => 'Alumnos',
                            'materias/lista' => 'Materias',
                            'profesores/lista' => 'Profesores',
                            'grupos/lista' => 'Grupos',
                            'procesos/registro/unidad' => 'Unidades'
                        );
                        ?>

                        <?php foreach ($registros as $ruta => $nombre): ?>
                            <li>
                                <a class="dropdown-item" href="<?= site_url($ruta); ?>">
                                    <?= html_escape($nombre); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Proceso
                    </a>

                    <ul class="dropdown-menu">
                        <?php
                        $procesos = array(
                            'procesos/registro/asignmat' => 'Asignación de materias',
                            'procesos/registro/inscripciongrup' => 'Inscripción a grupos',
                            'procesos/registro/captcal' => 'Captura por unidad',
                            'calificaciones/lista' => 'Calificaciones'
                        );
                        ?>

                        <?php foreach ($procesos as $ruta => $nombre): ?>
                            <li>
                                <a class="dropdown-item" href="<?= site_url($ruta); ?>">
                                    <?= html_escape($nombre); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Informes
                    </a>

                    <ul class="dropdown-menu">
                        <?php
                        $informes = array(
                        
                        );
                        ?>

                        <?php foreach ($informes as $ruta => $nombre): ?>
                            <li>
                                <a class="dropdown-item" href="<?= site_url($ruta); ?>">
                                    <?= html_escape($nombre); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

            <span class="navbar-text text-white">
                Sistema de Administración Escolar
            </span>
        </div>
    </div>
</nav>