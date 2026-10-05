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
        Registrar Grupo
    </h2>


    <form action="<?= site_url('grupos/guardar'); ?>"
          method="POST">


        <div class="mb-3">

            <label>Nombre del Grupo:</label>

            <input type="text"
                   name="descripcion_grup"
                   class="form-control"
                   placeholder="Ejemplo: 7T1"
                   required>

        </div>


        <div class="mb-3">

            <label>Estatus:</label>

            <select name="estatus_grup"
                    class="form-control"
                    required>

                <option value="alta">
                    Alta
                </option>

                <option value="baja">
                    Baja
                </option>

            </select>

        </div>


        <button type="submit"
                class="btn btn-success w-100">

            Registrar Grupo

        </button>


        <a href="<?= site_url('grupos/lista'); ?>"
           class="btn btn-secondary w-100 mt-2">

            Cancelar

        </a>

    </form>

</div>