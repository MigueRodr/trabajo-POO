<?php
require_once '../../class/c_documento_identidad.php';

$obj = new c_documento_identidad();
if (isset($_GET['nuip'])) {
    $obj->setNuip($_GET['nuip']);
    $obj->consultar();

    // Eliminar archivos asociados
    $campos = ['huella', 'foro_persona', 'firma_persona', 'qr', 'firma_registrador'];
    foreach ($campos as $campo) {
        $getter = 'get' . ucfirst($campo);
        $archivo = $obj->$getter();
        if ($archivo && file_exists('../../uploads/' . $archivo)) {
            unlink('../../uploads/' . $archivo);
        }
    }

    if ($obj->eliminar()) {
        header("Location: ../../l_documento_identidad.php?mensaje=eliminado");
    } else {
        header("Location: ../../l_documento_identidad.php?error=Error al eliminar");
    }
} else {
    header("Location: ../../l_documento_identidad.php");
}
exit;
?>