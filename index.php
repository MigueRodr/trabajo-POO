<?php
// Solo muestra el menú. No tiene lógica de negocio.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión - POO</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 (gratis) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding: 20px 0;
        }
        .sidebar .brand {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            padding: 10px 20px;
            border-bottom: 1px solid #334155;
            margin-bottom: 20px;
        }
        .sidebar .brand i {
            color: #38bdf8;
        }
        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: #334155;
            color: #fff;
            transform: translateX(5px);
        }
        .sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
            color: #38bdf8;
        }
        .sidebar .nav-link.active {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }
        .main-content {
            padding: 30px;
        }
        .card-welcome {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 30px;
            border: none;
        }
        .card-welcome h1 {
            color: #1e293b;
            font-weight: 700;
        }
        .card-welcome .lead {
            color: #64748b;
        }
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-left: 4px solid #2563eb;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }
        .stats-card .label {
            color: #64748b;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stats-card .icon {
            float: right;
            font-size: 2.5rem;
            color: #2563eb;
            opacity: 0.5;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                padding: 10px 0;
            }
            .main-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="brand">
                    <i class="fas fa-database"></i> POO Gestor
                </div>
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="l_documento_identidad.php">
                                <i class="fas fa-id-card"></i> Documentos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cr_documento_identidad.php">
                                <i class="fas fa-plus-circle"></i> Nuevo Documento
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 col-lg-10 main-content">
                <div class="card-welcome">
                    <h1><i class="fas fa-tachometer-alt text-primary me-2"></i>Panel de Control</h1>
                    <p class="lead">Bienvenido al sistema de gestión de documentos de identidad.</p>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="icon"><i class="fas fa-users"></i></div>
                                <div class="number">0</div>
                                <div class="label">Total Documentos</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card" style="border-left-color: #10b981;">
                                <div class="icon" style="color:#10b981;"><i class="fas fa-user-check"></i></div>
                                <div class="number">0</div>
                                <div class="label">Activos</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card" style="border-left-color: #f59e0b;">
                                <div class="icon" style="color:#f59e0b;"><i class="fas fa-clock"></i></div>
                                <div class="number">0</div>
                                <div class="label">Próximos a vencer</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="l_documento_identidad.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-id-card me-2"></i> Gestionar Documentos
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>