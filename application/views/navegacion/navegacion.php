<ul class="nav nav-pills">

  <li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle"
       data-bs-toggle="dropdown"
       href="#"
       role="button"
       aria-expanded="false">

       Registro

    </a>

    <ul class="dropdown-menu">

      <li>
        <a class="dropdown-item"
           href="<?= site_url('alumnos/registro'); ?>">
          Alumnos
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('materias/registro'); ?>">
          Materias
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('profesores/registro'); ?>">
          Profesores
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('grupos/registro'); ?>">
          Grupos
        </a>
      </li>

    </ul>

  </li>


  <li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle"
       data-bs-toggle="dropdown"
       href="#"
       role="button"
       aria-expanded="false">

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
       data-bs-toggle="dropdown"
       href="#"
       role="button"
       aria-expanded="false">

       Reportes

    </a>

    <ul class="dropdown-menu">

      <li>
        <a class="dropdown-item"
           href="<?= site_url('alumnos/lista'); ?>">
          Alumnos
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('materias/lista'); ?>">
          Materias
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('profesores/lista'); ?>">
          Profesores
        </a>
      </li>

      <li>
        <a class="dropdown-item"
           href="<?= site_url('grupos/lista'); ?>">
          Grupos
        </a>
      </li>

      <li>
        <hr class="dropdown-divider">
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