<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Documento_identidad
    include '../../class/c_documento_identidad.php';

    # CREAR EL OBJETO Documento_identidad
    $obj = new Documento_identidad();

    # Establecer propiedades del objeto
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
    $obj->setHuella($_POST['huella']);
    $obj->setForo_persona($_POST['foro_persona']);
    $obj->setFecha_expiracion($_POST['fecha_expiracion']);
    $obj->setFirma_persona($_POST['firma_persona']);
    $obj->setQr($_POST['qr']);
    $obj->setFirma_registrador($_POST['firma_registrador']);
    $obj->setCodigo_verificacion($_POST['codigo_verificacion']);

    # Insertar en la base de datos
    $obj->insertar();

    # Redirigir al listado
    header("Location: ../../l_documento_identidad.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?>