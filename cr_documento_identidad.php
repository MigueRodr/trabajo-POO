<?php
/* ---- Carga de datos para selects ---- */
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Crear Documento_identidad</title>
    <style>
        .form-container{max-width:600px;margin:20px auto;padding:20px;border:1px solid #ddd;border-radius:5px}
        .form-group{margin-bottom:15px}label{display:block;margin-bottom:5px;font-weight:bold}
        input,select,textarea{width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box}
        button{background:#4CAF50;color:white;padding:10px 15px;border:none;border-radius:4px;cursor:pointer}
        button:hover{background:#45a049}
        .back-link{display:inline-block;margin-top:10px;color:#007bff;text-decoration:none}
        .back-link:hover{text-decoration:underline}
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Crear Documento_identidad</h2>
        <form action="controllers/documento_identidad/op_crear.php" method="post">
            <div class="form-group">
                <label for="nuip">Nuip:</label>
                <input type="text" name="nuip" id="nuip" placeholder="Ingrese Nuip" required>
            </div>            <div class="form-group">
                <label for="tipo_documento">Tipo documento:</label>
                <input type="number" name="tipo_documento" id="tipo_documento" placeholder="Ingrese Tipo documento" required>
            </div>            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <textarea name="apellidos" id="apellidos" placeholder="Ingrese Apellidos" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <textarea name="nombres" id="nombres" placeholder="Ingrese Nombres" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="number" name="nacionalidad" id="nacionalidad" placeholder="Ingrese Nacionalidad" required>
            </div>            <div class="form-group">
                <label for="fecha_nacimiento">Fecha nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
            </div>            <div class="form-group">
                <label for="lugar_nacimiento">Lugar nacimiento:</label>
                <textarea name="lugar_nacimiento" id="lugar_nacimiento" placeholder="Ingrese Lugar nacimiento" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="estatura">Estatura:</label>
                <textarea name="estatura" id="estatura" placeholder="Ingrese Estatura" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" required>
                    <option value="1">M</option>
                    <option value="0">F</option>
                </select>
            </div>            <div class="form-group">
                <label for="grupo_sanguineo">Grupo sanguineo:</label>
                <textarea name="grupo_sanguineo" id="grupo_sanguineo" placeholder="Ingrese Grupo sanguineo" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="fecha_expedicion">Fecha expedicion:</label>
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" required>
            </div>            <div class="form-group">
                <label for="lugar_expedicion">Lugar expedicion:</label>
                <textarea name="lugar_expedicion" id="lugar_expedicion" placeholder="Ingrese Lugar expedicion" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="huella">Huella:</label>
                <textarea name="huella" id="huella" placeholder="Ingrese Huella" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="foro_persona">Foro persona:</label>
                <textarea name="foro_persona" id="foro_persona" placeholder="Ingrese Foro persona" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="fecha_expiracion">Fecha expiracion:</label>
                <input type="date" name="fecha_expiracion" id="fecha_expiracion" required>
            </div>            <div class="form-group">
                <label for="firma_persona">Firma persona:</label>
                <textarea name="firma_persona" id="firma_persona" placeholder="Ingrese Firma persona" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="qr">Qr:</label>
                <textarea name="qr" id="qr" placeholder="Ingrese Qr" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="firma_registrador">Firma registrador:</label>
                <textarea name="firma_registrador" id="firma_registrador" placeholder="Ingrese Firma registrador" required rows="4"></textarea>
            </div>            <div class="form-group">
                <label for="codigo_verificacion">Codigo verificacion:</label>
                <textarea name="codigo_verificacion" id="codigo_verificacion" placeholder="Ingrese Codigo verificacion" required rows="4"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
                <a href="l_documento_identidad.php" class="back-link">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>