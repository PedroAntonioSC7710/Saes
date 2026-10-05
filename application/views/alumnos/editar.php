<div class="container-registro"
     style="width: 500px;
     max-width: calc(100% - 40px);
     margin: 30px auto;
     padding: 30px;
     background: #6cafdf;
     border-radius: 8px;
     box-shadow: 0 4px 12px rgba(0,0,0,0.1);
     font-family: Arial, sans-serif;">

    <h2 style="text-align:center;">
        Editar Alumno
    </h2>

    <form action="<?= site_url('alumnos/actualizar/' . $alumno->id_alumn); ?>"
          method="POST">

        <div class="mb-3">

            <label>Nombre:</label>

            <input type="text"
                   name="nombre_al"
                   class="form-control"
                   value="<?= $alumno->nombre_al; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label>Apellido paterno:</label>

            <input type="text"
                   name="apaterno_al"
                   class="form-control"
                   value="<?= $alumno->apaterno_al; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label>Apellido materno:</label>

            <input type="text"
                   name="amaterno_al"
                   class="form-control"
                   value="<?= $alumno->amaterno_al; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label>Matrícula:</label>

            <input type="text"
                   name="matricula_al"
                   class="form-control"
                   value="<?= $alumno->matricula_al; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label>Teléfono:</label>

            <input type="text"
                   name="tel_al"
                   class="form-control"
                   value="<?= $alumno->tel_al; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label>Domicilio:</label>

            <input type="text"
                   name="dom_al"
                   class="form-control"
                   value="<?= $alumno->dom_al; ?>"
                   required>

        </div>

        <button type="submit"
                class="btn btn-success w-100">

            <i class="bi bi-save-fill"></i>
            Guardar Cambios

        </button>


        <a href="<?= site_url('alumnos/lista'); ?>"
           class="btn btn-secondary w-100 mt-2">

            Cancelar

        </a>

    </form>

</div>