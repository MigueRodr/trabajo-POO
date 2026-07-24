<?php
require_once '../../class/c_documento_identidad.php';

// Función de validación y subida de archivos
function subirArchivo($file, $nuip, $campo, $maxSize = 5242880) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tipo = mime_content_type($file['tmp_name']);
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($tipo, $tiposPermitidos)) {
            return ['error' => 'Tipo de archivo no permitido (solo JPG, PNG, GIF, WEBP)'];
        }
        if ($file['size'] > $maxSize) {
            return ['error' => 'El archivo excede el tamaño máximo de 5MB'];
        }
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nombre = $nuip . '_' . $campo . '_' . time() . '.' . $extension;
        $ruta = '../../uploads/' . $nombre;
        if (move_uploaded_file($file['tmp_name'], $ruta)) {
            return ['ruta' => $nombre];
        } else {
            return ['error' => 'Error al mover el archivo'];
        }
    }
    return ['ruta' => null];
}

$obj = new c_documento_identidad();

// Asignar datos básicos
$obj->setNuip($_POST['nuip']);
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

// Generar código de verificación
$codigoData = c_documento_identidad::generarCodigoVerificacion();
$obj->setCodigo_verificacion($codigoData['hash']);  // Guardamos el hash

// Subir archivos (excepto QR que se genera automáticamente)
$camposArchivos = ['huella', 'foro_persona', 'firma_persona', 'firma_registrador'];
foreach ($camposArchivos as $campo) {
    if ($_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
        $result = subirArchivo($_FILES[$campo], $_POST['nuip'], $campo);
        if (isset($result['error'])) {
            header("Location: ../../cr_documento_identidad.php?error=" . urlencode($result['error']));
            exit;
        }
        $setter = 'set' . ucfirst($campo);
        $obj->$setter($result['ruta']);
    } else {
        $setter = 'set' . ucfirst($campo);
        $obj->$setter('');
    }
}

// Insertar en BD (sin QR aún)
if ($obj->insertar()) {
    // Ahora generar el QR (necesita el NUIP ya guardado)
    if ($obj->generarQR()) {
        // Actualizar el campo QR en BD
        $obj->actualizar(); // Actualiza con la ruta del QR
    }
    // Guardar el código original en sesión o mostrarlo (lo pasamos por URL)
    header("Location: ../../l_documento_identidad.php?mensaje=creado&codigo=" . urlencode($codigoData['codigo']));
} else {
    header("Location: ../../cr_documento_identidad.php?error=Error al crear el documento");
}
exit;
?>