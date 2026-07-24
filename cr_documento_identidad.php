<?php
// No se necesita lógica aquí
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Documento</title>
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
        .form-card { background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; padding: 25px; }
        .form-card .card-header-custom { background: transparent; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px; }
        .form-card .card-header-custom h4 { font-weight: 700; color: #1e293b; }
        .form-label { font-weight: 600; color: #475569; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #e2e8f0; padding: 10px 15px; transition: all 0.3s; }
        .form-control:focus, .form-select:focus { border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }
        .preview-img { max-width: 100px; max-height: 100px; border-radius: 8px; object-fit: cover; border: 2px solid #e2e8f0; margin-top: 5px; }
        @media (max-width: 768px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 15px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="brand"><i class="fas fa-database"></i> POO Gestor</div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="l_documento_identidad.php"><i class="fas fa-id-card"></i> Documentos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-plus-circle"></i> Nuevo</a></li>
                </ul>
            </nav>

            <main class="col-md-9 col-lg-10 main-content">
                <div class="form-card">
                    <div class="card-header-custom">
                        <h4><i class="fas fa-file-circle-plus text-success me-2"></i>Nuevo Documento de Identidad</h4>
                    </div>
                    <form action="controllers/documento_identidad/op_crear.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nuip" class="form-label">NUIP *</label>
                                <input type="text" class="form-control" id="nuip" name="nuip" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo_documento" class="form-label">Tipo Documento *</label>
                                <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                                    <option value="">Seleccione...</option>
                                    <option value="1">Cédula de Ciudadanía</option>
                                    <option value="2">Tarjeta de Identidad</option>
                                    <option value="3">Registro Civil</option>
                                    <option value="4">Pasaporte</option>
                                    <option value="5">Cédula de Extranjería</option>
                                    <option value="6">Tarjeta de Extranjería</option>
                                    <option value="7">Permiso de Protección Temporal</option>
                                    <option value="8">Permiso Especial de Permanencia</option>
                                    <option value="9">NIT</option>
                                    <option value="10">Carné Diplomático</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos *</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">Nombres *</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <select class="form-select" id="nacionalidad" name="nacionalidad">
                                    <option value="">Seleccione...</option>
                                    <option value="57">Colombia</option>
                                    <option value="1">Estados Unidos</option>
                                    <option value="54">Argentina</option>
                                    <option value="56">Chile</option>
                                    <option value="52">México</option>
                                    <option value="34">España</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lugar_nacimiento" class="form-label">Lugar Nacimiento</label>
                                <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estatura" class="form-label">Estatura (cm)</label>
                                <input type="number" step="0.01" class="form-control" id="estatura" name="estatura">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="sexo" name="sexo">
                                    <option value="">Seleccione...</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
                                <select class="form-select" id="grupo_sanguineo" name="grupo_sanguineo">
                                    <option value="">Seleccione...</option>
                                    <option value="1">A+</option>
                                    <option value="2">A-</option>
                                    <option value="3">B+</option>
                                    <option value="4">B-</option>
                                    <option value="5">AB+</option>
                                    <option value="6">AB-</option>
                                    <option value="7">O+</option>
                                    <option value="8">O-</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_expedicion" class="form-label">Fecha Expedición</label>
                                <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lugar_expedicion" class="form-label">Lugar Expedición</label>
                                <input type="text" class="form-control" id="lugar_expedicion" name="lugar_expedicion">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_expiracion" class="form-label">Fecha Expiración</label>
                                <input type="date" class="form-control" id="fecha_expiracion" name="fecha_expiracion">
                            </div>
                        </div>

                        <!-- Archivos -->
                        <div class="row mt-3">
                            <h5 class="mb-3"><i class="fas fa-images text-primary me-2"></i>Archivos adjuntos</h5>
                            <?php
                            $campos = [
                                'huella' => 'Huella',
                                'foro_persona' => 'Foto de la persona',
                                'firma_persona' => 'Firma de la persona',
                                'firma_registrador' => 'Firma del registrador'
                            ];
                            foreach ($campos as $campo => $label): ?>
                            <div class="col-md-6 mb-3">
                                <label for="<?= $campo ?>" class="form-label"><?= $label ?></label>
                                <input type="file" class="form-control" id="<?= $campo ?>" name="<?= $campo ?>" accept="image/*" onchange="previewImage(this, 'preview_<?= $campo ?>')">
                                <div class="preview-container">
                                    <img id="preview_<?= $campo ?>" class="preview-img d-none" alt="Vista previa">
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="l_documento_identidad.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('d-none');
            }
        }
    </script>
</body>
</html>