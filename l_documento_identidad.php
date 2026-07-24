<?php
include_once 'class/c_documento_identidad.php';

// Crear objeto Documento_identidad
$documento_identidad = new Documento_identidad();

/* ¿Viene búsqueda? */
if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
    $res = $documento_identidad->buscar($_GET['buscar']);
} else {
    $res = $documento_identidad->listar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de documento_identidad</title>
</head>
<body>
    <h2>Listado de Documento_identidad</h2>

    <form action="l_documento_identidad.php" method="GET">
        <input type="text" name="buscar" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </form>

    <a href="cr_documento_identidad.php">Crear Nuevo</a>

    <table border="1">
        <thead>
            <tr>
                <td>Nuip</td>
                <td>Tipo documento</td>
                <td>Apellidos</td>
                <td>Nombres</td>
                <td>Nacionalidad</td>
                <td>Fecha nacimiento</td>
                <td>Lugar nacimiento</td>
                <td>Estatura</td>
                <td>Sexo</td>
                <td>Grupo sanguineo</td>
                <td>Fecha expedicion</td>
                <td>Lugar expedicion</td>
                <td>Huella</td>
                <td>Foro persona</td>
                <td>Fecha expiracion</td>
                <td>Firma persona</td>
                <td>Qr</td>
                <td>Firma registrador</td>
                <td>Codigo verificacion</td>
                <td colspan="2">Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($res as $registro): ?>
                <tr>
                    <td><?php echo $registro['nuip']; ?></td>
                    <td><?php echo $registro['tipo_documento']; ?></td>
                    <td><?php echo $registro['apellidos']; ?></td>
                    <td><?php echo $registro['nombres']; ?></td>
                    <td><?php echo $registro['nacionalidad']; ?></td>
                    <td><?php echo $registro['fecha_nacimiento']; ?></td>
                    <td><?php echo $registro['lugar_nacimiento']; ?></td>
                    <td><?php echo $registro['estatura']; ?></td>
                    <td><?php echo $registro['sexo']; ?></td>
                    <td><?php echo $registro['grupo_sanguineo']; ?></td>
                    <td><?php echo $registro['fecha_expedicion']; ?></td>
                    <td><?php echo $registro['lugar_expedicion']; ?></td>
                    <td><?php echo $registro['huella']; ?></td>
                    <td><?php echo $registro['foro_persona']; ?></td>
                    <td><?php echo $registro['fecha_expiracion']; ?></td>
                    <td><?php echo $registro['firma_persona']; ?></td>
                    <td><?php echo $registro['qr']; ?></td>
                    <td><?php echo $registro['firma_registrador']; ?></td>
                    <td><?php echo $registro['codigo_verificacion']; ?></td>
                    <td>
                        <form action="ac_documento_identidad.php" method="POST">
                            <input type="hidden" name="nuip" value="<?php echo $registro['nuip']; ?>">
                            <button type="submit">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="controllers/documento_identidad/op_eliminar.php" method="POST">
                            <input type="hidden" name="nuip" value="<?php echo $registro['nuip']; ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php">Volver al Menú</a>
</body>
</html>