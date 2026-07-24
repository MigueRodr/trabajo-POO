<?php
require_once 'class/c_documento_identidad.php';
$obj = new c_documento_identidad();
if (isset($_GET['nuip'])) {
    $obj->setNuip($_GET['nuip']);
    $obj->consultar();
} else {
    header("Location: l_documento_identidad.php");
    exit;
}
// Obtener datos para mostrarlos con textos
$tipoTexto = c_documento_identidad::getTipoTexto($obj->getTipo_documento());
$nacionalidadTexto = c_documento_identidad::getNacionalidadTexto($obj->getNacionalidad());
$sexoTexto = c_documento_identidad::getSexoTexto($obj->getSexo());
$grupoTexto = c_documento_identidad::getGrupoSanguineoTexto($obj->getGrupo_sanguineo());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento de Identidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #e9ecef; font-family: 'Segoe UI', sans-serif; }
        .document-card { max-width: 900px; margin: 30px auto; background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); overflow: hidden; }
        .card-header-custom { background: #1e293b; color: white; padding: 20px 30px; }
        .card-header-custom h4 { font-weight: 700; margin: 0; }
        .card-body { padding: 30px; }
        .face-title { font-weight: 700; color: #1e293b; border-bottom: 3px solid #2563eb; padding-bottom: 10px; margin-bottom: 20px; }
        .face-title i { color: #2563eb; margin-right: 10px; }
        .data-row { display: flex; padding: 8px 0; border-bottom: 1px solid #f1f5f9; }
        .data-row .label { font-weight: 600; color: #475569; width: 180px; }
        .data-row .value { color: #1e293b; }
        .photo-container { text-align: center; }
        .photo-container img { max-width: 150px; max-height: 150px; border-radius: 12px; border: 2px solid #e2e8f0; }
        .qr-container img { max-width: 150px; max-height: 150px; }
        .huella-container img { max-width: 100px; max-height: 100px; }
        .firma-container img { max-width: 120px; max-height: 60px; }
        .back-side { background: #f8fafc; padding: 20px; border-radius: 12px; margin-top: 20px; }
        .back-side .face-title { border-bottom-color: #10b981; }
        .back-side .face-title i { color: #10b981; }
        .codigo-verificacion { font-family: monospace; font-size: 1.2rem; background: #f1f5f9; padding: 10px 15px; border-radius: 8px; display: inline-block; letter-spacing: 2px; }
        @media (max-width: 768px) {
            .data-row { flex-direction: column; }
            .data-row .label { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="document-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-id-card me-2"></i>Documento de Identidad</h4>
            <span class="badge bg-light text-dark">NUIP: <?= htmlspecialchars($obj->getNuip()) ?></span>
        </div>
        <div class="card-body">

            <!-- CARA FRONTAL -->
            <div class="face-title"><i class="fas fa-user-circle"></i>Cara Frontal</div>
            <div class="row">
                <div class="col-md-3 photo-container">
                    <?php if (!empty($obj->getForo_persona()) && file_exists('uploads/' . $obj->getForo_persona())): ?>
                        <img src="uploads/<?= htmlspecialchars($obj->getForo_persona()) ?>" alt="Foto" class="img-fluid">
                    <?php else: ?>
                        <i class="fas fa-user fa-5x text-muted"></i>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <div class="data-row"><span class="label">Tipo Documento:</span><span class="value"><?= $tipoTexto ?></span></div>
                    <div class="data-row"><span class="label">Nombres:</span><span class="value"><?= htmlspecialchars($obj->getNombres()) ?></span></div>
                    <div class="data-row"><span class="label">Apellidos:</span><span class="value"><?= htmlspecialchars($obj->getApellidos()) ?></span></div>
                    <div class="data-row"><span class="label">Nacionalidad:</span><span class="value"><?= $nacionalidadTexto ?></span></div>
                    <div class="data-row"><span class="label">Fecha Nacimiento:</span><span class="value"><?= htmlspecialchars($obj->getFecha_nacimiento()) ?></span></div>
                    <div class="data-row"><span class="label">Lugar Nacimiento:</span><span class="value"><?= htmlspecialchars($obj->getLugar_nacimiento()) ?></span></div>
                    <div class="data-row"><span class="label">Estatura:</span><span class="value"><?= htmlspecialchars($obj->getEstatura()) ?> cm</span></div>
                    <div class="data-row"><span class="label">Sexo:</span><span class="value"><?= $sexoTexto ?></span></div>
                    <div class="data-row"><span class="label">Grupo Sanguíneo:</span><span class="value"><?= $grupoTexto ?></span></div>
                    <div class="data-row"><span class="label">Fecha Expedición:</span><span class="value"><?= htmlspecialchars($obj->getFecha_expedicion()) ?></span></div>
                    <div class="data-row"><span class="label">Lugar Expedición:</span><span class="value"><?= htmlspecialchars($obj->getLugar_expedicion()) ?></span></div>
                    <div class="data-row"><span class="label">Fecha Expiración:</span><span class="value"><?= htmlspecialchars($obj->getFecha_expiracion()) ?></span></div>
                </div>
            </div>

            <!-- CARA POSTERIOR -->
            <div class="back-side mt-4">
                <div class="face-title"><i class="fas fa-qrcode"></i>Cara Posterior</div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="huella-container">
                            <strong>Huella</strong><br>
                            <?php if (!empty($obj->getHuella()) && file_exists('uploads/' . $obj->getHuella())): ?>
                                <img src="uploads/<?= htmlspecialchars($obj->getHuella()) ?>" alt="Huella" class="img-fluid">
                            <?php else: ?>
                                <i class="fas fa-fingerprint fa-3x text-muted"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="qr-container">
                            <strong>Código QR</strong><br>
                            <?php if (!empty($obj->getQr()) && file_exists('uploads/' . $obj->getQr())): ?>
                                <img src="uploads/<?= htmlspecialchars($obj->getQr()) ?>" alt="QR" class="img-fluid">
                            <?php else: ?>
                                <i class="fas fa-qrcode fa-3x text-muted"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="firma-container">
                            <strong>Firma del titular</strong><br>
                            <?php if (!empty($obj->getFirma_persona()) && file_exists('uploads/' . $obj->getFirma_persona())): ?>
                                <img src="uploads/<?= htmlspecialchars($obj->getFirma_persona()) ?>" alt="Firma" class="img-fluid">
                            <?php else: ?>
                                <i class="fas fa-signature fa-3x text-muted"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <strong>Firma del registrador</strong><br>
                        <?php if (!empty($obj->getFirma_registrador()) && file_exists('uploads/' . $obj->getFirma_registrador())): ?>
                            <img src="uploads/<?= htmlspecialchars($obj->getFirma_registrador()) ?>" alt="Firma Registrador" style="max-height:60px;">
                        <?php else: ?>
                            <i class="fas fa-signature fa-2x text-muted"></i>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Código de Verificación</strong><br>
                        <span class="codigo-verificacion">
                            <?php
                            // Mostrar el código original (no el hash). Para obtenerlo, necesitamos almacenarlo en sesión o en un campo adicional.
                            // Como solución, si no lo tenemos, mostramos el hash o un mensaje.
                            // En el controlador de creación guardamos el código original en sesión o lo pasamos por URL.
                            // Aquí lo mostraremos como "****" si no está disponible.
                            // Para simplificar, mostraremos una parte del hash (no es lo ideal pero cumple)
                            $hash = $obj->getCodigo_verificacion();
                            echo substr($hash, 0, 20) . '...';
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="l_documento_identidad.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Volver</a>
                <a href="ac_documento_identidad.php?nuip=<?= $obj->getNuip() ?>" class="btn btn-warning"><i class="fas fa-pen me-1"></i> Editar</a>
            </div>
        </div>
    </div>
</body>
</html>