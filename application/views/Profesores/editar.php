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
        Editar Profesor
    </h2>

    <form action="<?= site_url('profesores/actualizar/' . $profesor->id_prof); ?>"
          method="POST">

        <div class="mb-3">
            <label>No. de Control:</label>

            <input type="text"
                   name="nocontrol_prof"
                   class="form-control"
                   value="<?= $profesor->nocontrol_prof; ?>"
                   required>
        </div>


        <div class="mb-3">
            <label>Nombre:</label>

            <input type="text"
                   name="nombre_prof"
                   class="form-control"
                   value="<?= $profesor->nombre_prof; ?>"
                   required>
        </div>


        <div class="mb-3">
            <label>Apellido Paterno:</label>

            <input type="text"
                   name="apellidop_prof"
                   class="form-control"
                   value="<?= $profesor->apellidop_prof; ?>"
                   required>
        </div>


        <div class="mb-3">
            <label>Apellido Materno:</label>

            <input type="text"
                   name="apellidom_prof"
                   class="form-control"
                   value="<?= $profesor->apellidom_prof; ?>"
                   required>
        </div>


        <div class="mb-3">
            <label>Teléfono:</label>

            <input type="text"
                   name="tel_prof"
                   class="form-control"
                   value="<?= $profesor->tel_prof; ?>"
                   required>
        </div>


        <div class="mb-3">
            <label>Domicilio:</label>

            <input type="text"
                   name="dom_prof"
                   class="form-control"
                   value="<?= $profesor->dom_prof; ?>"
                   required>
        </div>

            </select>
        </div>


        <button type="submit"
                class="btn btn-success w-100">

            Guardar Cambios

        </button>


        <a href="<?= site_url('profesores/lista'); ?>"
           class="btn btn-secondary w-100 mt-2">

            Cancelar

        </a>

    </form>

</div>