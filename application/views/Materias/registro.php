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
        Registrar Materia
    </h2>

    <form action="<?= site_url('materias/guardar'); ?>"
          method="POST">

        <div class="mb-3">

            <label>Nombre de la materia:</label>

            <input type="text"
                   name="descripcion_mat"
                   class="form-control"
                   required>

        </div>

        <button type="submit"
                class="btn btn-success w-100">

            Registrar Materia

        </button>


        <a href="<?= site_url('materias/lista'); ?>"
           class="btn btn-secondary w-100 mt-2">

            Cancelar

        </a>

    </form>

</div>