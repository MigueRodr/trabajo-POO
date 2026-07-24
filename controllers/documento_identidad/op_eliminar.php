<?php
# Incluir la clase Documento_identidad
include '../../class/c_documento_identidad.php';

# Crear el objeto Documento_identidad
$obj = new Documento_identidad();

# Establecer la clave primaria para eliminar
$obj->setNuip($_POST['nuip']);

# Eliminar de la base de datos
$obj->eliminar();

# Redirigir al listado
header("Location: ../../l_documento_identidad.php");
?>