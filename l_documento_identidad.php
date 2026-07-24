<?php
require_once 'class/c_documento_identidad.php';
$obj = new c_documento_identidad();
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
$res = $obj->listar($buscar);
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Documentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%); padding: 20px 0; }
        .sidebar .brand { color: #fff; font-size: 1.5rem; font-weight: 700; padding: 10px 20px; border-bottom: 1px solid #334155; margin-bottom: 20px; }
        .sidebar .brand i { color: #38bdf8; }
        .sidebar .nav-link { color: #cbd5e1; padding: 12px 20px; border-radius: 8px; margin: 4px 10px; transition: all 0.3s; }
        .sidebar .nav-link:hover { background: #334155; color: #fff; transform: translateX(5px); }
        .sidebar .nav-link i { width: 24px; margin-right: 10px; color: #38bdf8; }
        .sidebar .nav-link.active { background: #2563eb; color: #fff; box-shadow: 0 4px 12px rgba(37,99,235,0.4); }
        .main-content { padding: 30px; }
        .card-table { background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; overflow: hidden; }
        .card-table .card-header { background: white; border-bottom: 1px solid #e2e8f0; padding: 20px 25px; }
        .card-table .card-header h4 { font-weight: 700; color: #1e293b; }
        .table thead th { background: #f8fafc; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
        .table tbody tr:hover { background: #f1f5f9; }
        .badge-estado { padding: 6px 12px; border-radius: 20px; font-weight: 500; }
        .btn-accion { width: 36px; height: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .btn-accion:hover { transform: scale(1.05); }
        .alert-toast { position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; }
        @media (max-width: 768px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 15px; }
        }
    </style>
</head>
<body>
    <div class="alert-toast" id="toastContainer"></div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="brand"><i class="fas fa-database"></i> POO Gestor</div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-id-card"></i> Documentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="cr_documento_identidad.php"><i class="fas fa-plus-circle"></i> Nuevo</a></li>
                </ul>
            </nav>

            <main class="col-md-9 col-lg-10 main-content">
                <div class="card-table">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h4><i class="fas fa-list-ul text-primary me-2"></i>Documentos de Identidad</h4>
                        <a href="cr_documento_identidad.php" class="btn btn-primary"><i class="fas fa-plus-circle me-1"></i> Nuevo</a>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3 mb-4">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por NUIP, apellidos o nombres..." value="<?= htmlspecialchars($buscar) ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Buscar</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>NUIP</th>
                                        <th>Tipo</th>
                                        <th>Apellidos</th>
                                        <th>Nombres</th>
                                        <th>Nacionalidad</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($res && count($res) > 0): ?>
                                        <?php foreach ($res as $row):
                                            $estado = 'Vigente';
                                            $badgeClass = 'bg-success';
                                            if (!empty($row['fecha_expiracion']) && $row['fecha_expiracion'] < date('Y-m-d')) {
                                                $estado = 'Vencido';
                                                $badgeClass = 'bg-danger';
                                            } elseif (!empty($row['fecha_expiracion']) && $row['fecha_expiracion'] <= date('Y-m-d', strtotime('+30 days'))) {
                                                $estado = 'Próximo a vencer';
                                                $badgeClass = 'bg-warning text-dark';
                                            }
                                        ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($row['nuip']) ?></strong></td>
                                            <td><?= c_documento_identidad::getTipoTexto($row['tipo_documento']) ?></td>
                                            <td><?= htmlspecialchars($row['apellidos']) ?></td>
                                            <td><?= htmlspecialchars($row['nombres']) ?></td>
                                            <td><?= c_documento_identidad::getNacionalidadTexto($row['nacionalidad']) ?></td>
                                            <td><span class="badge <?= $badgeClass ?> badge-estado"><?= $estado ?></span></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="v_documento_identidad.php?nuip=<?= $row['nuip'] ?>" class="btn btn-info btn-accion" title="Ver Detalles (Documento)">
                                                        <i class="fas fa-id-card text-white"></i>
                                                    </a>
                                                    <a href="ac_documento_identidad.php?nuip=<?= $row['nuip'] ?>" class="btn btn-warning btn-accion" title="Editar">
                                                        <i class="fas fa-pen text-white"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-accion" title="Eliminar" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-nuip="<?= $row['nuip'] ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="7" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>No hay registros.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-muted">Mostrando <?= count($res) ?> registros</span>
                            <nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">Siguiente</a></li></ul></nav>
                        </div>
                        <div class="mt-3"><a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Volver</a></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirmar eliminación</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">¿Está seguro de eliminar este documento? También se eliminarán los archivos asociados.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mensaje = '<?= $mensaje ?>';
            const codigo = '<?= $codigo ?>';
            const error = '<?= $error ?>';
            const toastContainer = document.getElementById('toastContainer');
            if (mensaje) {
                let html = `<div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>${mensaje}`;
                if (codigo) html += ` - Código de verificación: <strong>${codigo}</strong>`;
                html += `<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
                toastContainer.innerHTML = html;
                setTimeout(() => toastContainer.innerHTML = '', 8000);
            }
            if (error) {
                toastContainer.innerHTML = `<div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-times-circle me-2"></i>Error: ${error}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
                setTimeout(() => toastContainer.innerHTML = '', 8000);
            }

            const modalEliminar = document.getElementById('modalEliminar');
            modalEliminar.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const nuip = button.getAttribute('data-nuip');
                document.getElementById('confirmDeleteBtn').href = `controllers/documento_identidad/op_eliminar.php?nuip=${nuip}`;
            });
        });
    </script>
</body>
</html>