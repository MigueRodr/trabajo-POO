<?php
/* ---- Carga de datos y registro actual ---- */
/* Leer registro a editar */
include_once 'class/c_documento_identidad.php';
$documento_identidad = new Documento_identidad();
$documento_identidad->setnuip($_POST['nuip']);
$documento_identidad->consultar();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Actualizar Documento_identidad</title>
    <style>
        .form-container{max-width:600px;margin:20px auto;padding:20px;border:1px solid #ddd;border-radius:5px}
        .form-group{margin-bottom:15px}label{display:block;margin-bottom:5px;font-weight:bold}
        input,select,textarea{width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;box-sizing:border-box}
        button{background:#007bff;color:white;padding:10px 15px;border:none;border-radius:4px;cursor:pointer}
        button:hover{background:#0056b3}
        .back-link{display:inline-block;margin-top:10px;color:#007bff;text-decoration:none}
        .back-link:hover{text-decoration:underline}
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Actualizar Documento_identidad</h2>
        <form action="controllers/documento_identidad/op_actualizar.php" method="post">
            <input type="hidden" name="nuip" value="<?= $documento_identidad->getNuip() ?>">
                        <div class="form-group">
                <label for="nuip">Nuip:</label>
                <input type="text" name="nuip" id="nuip" placeholder="Ingrese Nuip" value="<?= htmlspecialchars($documento_identidad->getNuip()) ?>" required>
            </div>            <div class="form-group">
                <label for="tipo_documento">Tipo documento:</label>
                <input type="number" name="tipo_documento" id="tipo_documento" placeholder="Ingrese Tipo documento" value="<?= htmlspecialchars($documento_identidad->getTipo_documento()) ?>" required>
            </div>            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <textarea name="apellidos" id="apellidos" placeholder="Ingrese Apellidos" required rows="4"><?= htmlspecialchars($documento_identidad->getApellidos()) ?></textarea>
            </div>            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <textarea name="nombres" id="nombres" placeholder="Ingrese Nombres" required rows="4"><?= htmlspecialchars($documento_identidad->getNombres()) ?></textarea>
            </div>            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="number" name="nacionalidad" id="nacionalidad" placeholder="Ingrese Nacionalidad" value="<?= htmlspecialchars($documento_identidad->getNacionalidad()) ?>" required>
            </div>            <div class="form-group">
                <label for="fecha_nacimiento">Fecha nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $documento_identidad->getFecha_nacimiento() ?>" required>
            </div>            <div class="form-group">
                <label for="lugar_nacimiento">Lugar nacimiento:</label>
                <textarea name="lugar_nacimiento" id="lugar_nacimiento" placeholder="Ingrese Lugar nacimiento" required rows="4"><?= htmlspecialchars($documento_identidad->getLugar_nacimiento()) ?></textarea>
            </div>            <div class="form-group">
                <label for="estatura">Estatura:</label>
                <textarea name="estatura" id="estatura" placeholder="Ingrese Estatura" required rows="4"><?= htmlspecialchars($documento_identidad->getEstatura()) ?></textarea>
            </div>            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" required>
                    <option value="1" <?= $documento_identidad->getSexo() == '1' ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= $documento_identidad->getSexo() == '0' ? 'selected' : '' ?>>No</option>
                </select>
            </div>            <div class="form-group">
                <label for="grupo_sanguineo">Grupo sanguineo:</label>
                <textarea name="grupo_sanguineo" id="grupo_sanguineo" placeholder="Ingrese Grupo sanguineo" required rows="4"><?= htmlspecialchars($documento_identidad->getGrupo_sanguineo()) ?></textarea>
            </div>            <div class="form-group">
                <label for="fecha_expedicion">Fecha expedicion:</label>
                <input type="date" name="fecha_expedicion" id="fecha_expedicion" value="<?= $documento_identidad->getFecha_expedicion() ?>" required>
            </div>            <div class="form-group">
                <label for="lugar_expedicion">Lugar expedicion:</label>
                <textarea name="lugar_expedicion" id="lugar_expedicion" placeholder="Ingrese Lugar expedicion" required rows="4"><?= htmlspecialchars($documento_identidad->getLugar_expedicion()) ?></textarea>
            </div>            <div class="form-group">
                <label for="huella">Huella:</label>
                <textarea name="huella" id="huella" placeholder="Ingrese Huella" required rows="4"><?= htmlspecialchars($documento_identidad->getHuella()) ?></textarea>
            </div>            <div class="form-group">
                <label for="foro_persona">Foro persona:</label>
                <textarea name="foro_persona" id="foro_persona" placeholder="Ingrese Foro persona" required rows="4"><?= htmlspecialchars($documento_identidad->getForo_persona()) ?></textarea>
            </div>            <div class="form-group">
                <label for="fecha_expiracion">Fecha expiracion:</label>
                <input type="date" name="fecha_expiracion" id="fecha_expiracion" value="<?= $documento_identidad->getFecha_expiracion() ?>" required>
            </div>            <div class="form-group">
                <label for="firma_persona">Firma persona:</label>
                <textarea name="firma_persona" id="firma_persona" placeholder="Ingrese Firma persona" required rows="4"><?= htmlspecialchars($documento_identidad->getFirma_persona()) ?></textarea>
            </div>            <div class="form-group">
                <label for="qr">Qr:</label>
                <textarea name="qr" id="qr" placeholder="Ingrese Qr" required rows="4"><?= htmlspecialchars($documento_identidad->getQr()) ?></textarea>
            </div>            <div class="form-group">
                <label for="firma_registrador">Firma registrador:</label>
                <textarea name="firma_registrador" id="firma_registrador" placeholder="Ingrese Firma registrador" required rows="4"><?= htmlspecialchars($documento_identidad->getFirma_registrador()) ?></textarea>
            </div>            <div class="form-group">
                <label for="codigo_verificacion">Codigo verificacion:</label>
                <textarea name="codigo_verificacion" id="codigo_verificacion" placeholder="Ingrese Codigo verificacion" required rows="4"><?= htmlspecialchars($documento_identidad->getCodigo_verificacion()) ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Guardar cambios</button>
                <a href="l_documento_identidad.php" class="back-link">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>