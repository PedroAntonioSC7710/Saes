<div class="container-registro" style="width: 500px; max-width: calc(100% - 40px); margin: 30px auto; padding: 30px; background: #6cafdf; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); font-family: Arial, sans-serif; box-sizing: border-box;">
    <h2 style="text-align: center; color: #000000; margin-bottom: 25px; font-size: 22px;">Registro de Alumno</h2>
    
    <form action="#" method="POST" id="form-registro">
        
        
        <div style="margin-bottom: 15px;">
            <label for="nombre" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        
        <div style="margin-bottom: 15px;">
            <label for="matricula" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        
        <div style="margin-bottom: 15px;">
            <label for="correo" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Correo Institucional:</label>
            <input type="email" id="correo" name="correo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        
        <div style="margin-bottom: 15px;">
            <label for="carrera" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Carrera:</label>
            <select id="carrera" name="carrera" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                <option value="">Selecciona la carrera</option>
                <option value="tics">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
                <option value="sistemas">Ingeniería Industrial</option>
                <option value="administracion">Licenciatura en Administración de Empresas</option>
            </select>
        </div>

        
        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label for="grado" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Grado (Semestre):</label>
                <select id="grado" name="grado" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                    <option value="">Selecciona</option>
                    <option value="1">1er Semestre</option>
                    <option value="2">2do Semestre</option>
                    <option value="3">3er Semestre</option>
                    <option value="4">4to Semestre</option>
                    <option value="5">5to Semestre</option>
                    <option value="6">6to Semestre</option>
                    <option value="7">7mo Semestre</option>
                    <option value="8">8vo Semestre</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label for="grupo" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Grupo:</label>
                <input type="text" id="grupo" name="grupo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Contraseña:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        
        <div style="margin-bottom: 20px;">
            <label for="confirm_password" style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

       
        <button type="submit" style="width: 100%; padding: 12px; background-color: #0f3c0f; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer;">
            Registrar Alumno
        </button>

    </form>
</div>