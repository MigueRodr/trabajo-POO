<?php
require_once '../../class/c_documento_identidad.php';

function subirArchivo($file, $nuip, $campo, $maxSize = 5242880) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tipo = mime_content_type($file['tmp_name']);
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($tipo, $tiposPermitidos)) {
            return ['error' => 'Tipo de archivo no permitido'];
        }
        if ($file['size'] > $maxSize) {
            return ['error' => 'El archivo excede 5MB'];
        }
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nombre = $nuip . '_' . $campo . '_' . time() . '.' . $extension;
        $ruta = '../../uploads/' . $nombre;
        if (move_uploaded_file($file['tmp_name'], $ruta)) {
            return ['ruta' => $nombre];
        } else {
            return ['error' => 'Error al mover archivo'];
        }
    }
    return ['ruta' => null];
}

$obj = new c_documento_identidad();
$obj->setNuip($_POST['nuip']);
$obj->consultar(); // Cargar datos actuales

// Actualizar campos básicos
$obj->setTipo_documento($_POST['tipo_documento']);
$obj->setApellidos($_POST['apellidos']);
$obj->setNombres($_POST['nombres']);
$obj->setNacionalidad($_POST['nacionalidad']);
$obj->setFecha_nacimiento($_POST['fecha_nacimiento']);
$obj->setLugar_nacimiento($_POST['lugar_nacimiento']);
$obj->setEstatura($_POST['estatura']);
$obj->setSexo($_POST['sexo']);
$obj->setGrupo_sanguineo($_POST['grupo_sanguineo']);
$obj->setFecha_expedicion($_POST['fecha_expedicion']);
$obj->setLugar_expedicion($_POST['lugar_expedicion']);
$obj->setFecha_expiracion($_POST['fecha_expiracion']);

// Actualizar archivos (si se suben nuevos)
$camposArchivos = ['huella', 'foro_persona', 'firma_persona', 'firma_registrador'];
foreach ($camposArchivos as $campo) {
    if ($_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
        // Eliminar archivo anterior si existe
        $getter = 'get' . ucfirst($campo);
        $archivoViejo = $obj->$getter();
        if ($archivoViejo && file_exists('../../uploads/' . $archivoViejo)) {
            unlink('../../uploads/' . $archivoViejo);
        }
        // Subir nuevo
        $result = subirArchivo($_FILES[$campo], $_POST['nuip'], $campo);
        if (isset($result['error'])) {
            header("Location: ../../ac_documento_identidad.php?nuip=" . $_POST['nuip'] . "&error=" . urlencode($result['error']));
            exit;
        }
        $setter = 'set' . ucfirst($campo);
        $obj->$setter($result['ruta']);
    }
}

// Re-generar QR (si cambian datos relevantes)
$obj->generarQR(); // Actualiza la propiedad qr con la nueva ruta

// Actualizar en BD
if ($obj->actualizar()) {
    header("Location: ../../l_documento_identidad.php?mensaje=actualizado");
} else {
    header("Location: ../../ac_documento_identidad.php?nuip=" . $_POST['nuip'] . "&error=Error al actualizar");
}
exit;
?>