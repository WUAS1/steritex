<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Steritex - Sistema de Fallas'); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --steritex-primary: #2c3e50;
            --steritex-secondary: #3498db;
            --steritex-danger: #e74c3c;
            --steritex-warning: #f39c12;
        }
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, var(--steritex-primary) 0%, #1a252f 100%);
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: white;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link {
            color: var(--steritex-primary);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: var(--steritex-secondary);
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: var(--steritex-primary);
            color: white;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background-color: var(--steritex-secondary);
            border-color: var(--steritex-secondary);
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .stat-card {
            border-left: 4px solid var(--steritex-secondary);
        }
        .table th {
            background-color: var(--steritex-primary);
            color: white;
            font-weight: 500;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?php echo e(auth()->check() ? (auth()->user()->isAdministrador() ? route('dashboard') : route('fallas.index')) : route('login')); ?>">
                <i class="bi bi-factory"></i> Steritex
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?php echo e(auth()->user()->name); ?>

                                <span class="badge bg-<?php echo e(auth()->user()->rol === 'administrador' ? 'success' : 'warning'); ?> ms-1">
                                    <?php echo e(ucfirst(auth()->user()->rol)); ?>

                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item-text text-muted small">
                                    <i class="bi bi-envelope"></i> <?php echo e(auth()->user()->email); ?>

                                </span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar para Administrador -->
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdministrador()): ?>
                <div class="col-md-3 col-lg-2 sidebar py-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('reportes.*') ? 'active' : ''); ?>" href="<?php echo e(route('reportes.index')); ?>">
                                <i class="bi bi-bar-chart me-2"></i> Reportes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('fallas.*') ? 'active' : ''); ?>" href="<?php echo e(route('fallas.index')); ?>">
                                <i class="bi bi-exclamation-triangle me-2"></i> Fallas
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-lg-10">
                <?php else: ?>
                <div class="col-12">
                <?php endif; ?>
            <?php else: ?>
                <div class="col-12">
            <?php endif; ?>
            
                    <!-- Mensajes de alerta -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i> <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>

<?php /**PATH C:\Users\PC\Videos\sistema\resources\views/layouts/app.blade.php ENDPATH**/ ?>