

<?php $__env->startSection('title', 'Registro de Fallas - Steritex'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="bi bi-exclamation-triangle"></i> Registro de Fallas</h2>
            <p class="text-muted mb-0">Sistema de conteo de unidades (Scrap y Reproceso)</p>
        </div>
        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->isAdministrador()): ?>
            <div>
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-primary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="<?php echo e(route('reportes.index')); ?>" class="btn btn-outline-success">
                    <i class="bi bi-bar-chart"></i> Reportes
                </a>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('fallas.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label">Desde</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" 
                           value="<?php echo e(request('fecha_inicio')); ?>">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label">Hasta</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" 
                           value="<?php echo e(request('fecha_fin')); ?>">
                </div>
                <div class="col-md-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" id="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="Scrap" <?php echo e(request('tipo') == 'Scrap' ? 'selected' : ''); ?>>Scrap</option>
                        <option value="Reproceso" <?php echo e(request('tipo') == 'Reproceso' ? 'selected' : ''); ?>>Reproceso</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <a href="<?php echo e(route('fallas.index')); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Limpiar
                    </a>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('reportes.export.excel', request()->query())); ?>" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </a>
                        <a href="<?php echo e(route('reportes.export.pdf', request()->query())); ?>" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resumen de totales -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-trash"></i> Total Scrap</h5>
                    <p class="card-text fs-2"><?php echo e(number_format($totalScrap)); ?></p>
                    <small>unidades</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-arrow-repeat"></i> Total Reproceso</h5>
                    <p class="card-text fs-2"><?php echo e(number_format($totalReproceso)); ?></p>
                    <small>unidades</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Nuevo Registro</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('fallas.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <!-- Tipo de falla -->
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo de Falla</label>
                        <select name="tipo" id="tipo" class="form-select <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Seleccione...</option>
                            <option value="Scrap" <?php echo e(old('tipo')=='Scrap'?'selected':''); ?>>Scrap</option>
                            <option value="Reproceso" <?php echo e(old('tipo')=='Reproceso'?'selected':''); ?>>Reproceso</option>
                        </select>
                        <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Cantidad (sin costos) -->
                    <div class="col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" 
                               name="cantidad" 
                               id="cantidad" 
                               class="form-control <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('cantidad')); ?>" 
                               min="1" 
                               required>
                        <small class="text-muted">Unidades</small>
                        <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Motivo -->
                    <div class="col-md-4">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" 
                               name="motivo" 
                               id="motivo" 
                               class="form-control <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('motivo')); ?>" 
                               placeholder="Descripción de la falla"
                               required>
                        <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Selector de Fecha -->
                    <div class="col-md-2">
                        <label for="fecha_date" class="form-label">Fecha</label>
                        <input type="date" 
                               name="fecha_date" 
                               id="fecha_date" 
                               class="form-control <?php $__errorArgs = ['fecha_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('fecha_date', date('Y-m-d'))); ?>" 
                               required>
                        <?php $__errorArgs = ['fecha_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Selector de Hora -->
                    <div class="col-md-1">
                        <label for="fecha_time" class="form-label">Hora</label>
                        <input type="time" 
                               name="fecha_time" 
                               id="fecha_time" 
                               class="form-control <?php $__errorArgs = ['fecha_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('fecha_time', date('H:i'))); ?>" 
                               required>
                        <?php $__errorArgs = ['fecha_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Registros -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list"></i> Historial de Registros</h5>
            <span class="badge bg-secondary"><?php echo e($registros->count()); ?> registros</span>
        </div>
        <div class="card-body">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdministrador()): ?>
                    <div class="mb-3">
                        <form action="<?php echo e(route('reportes.export.excel')); ?>" method="GET" class="d-inline">
                            <input type="hidden" name="fecha_inicio" value="<?php echo e(request('fecha_inicio')); ?>">
                            <input type="hidden" name="fecha_fin" value="<?php echo e(request('fecha_fin')); ?>">
                            <input type="hidden" name="tipo" value="<?php echo e(request('tipo')); ?>">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                            </button>
                        </form>
                        <form action="<?php echo e(route('reportes.export.pdf')); ?>" method="GET" class="d-inline">
                            <input type="hidden" name="fecha_inicio" value="<?php echo e(request('fecha_inicio')); ?>">
                            <input type="hidden" name="fecha_fin" value="<?php echo e(request('fecha_fin')); ?>">
                            <input type="hidden" name="tipo" value="<?php echo e(request('tipo')); ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if($registros->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(auth()->user()->isAdministrador()): ?>
                                        <th>Acciones</th>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($r->id); ?></td>
                                    <td>
                                        <?php if($r->tipo === 'Scrap'): ?>
                                            <span class="badge bg-danger">Scrap</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Reproceso</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($r->cantidad); ?></td>
                                    <td><?php echo e($r->motivo); ?></td>
                                    <td><?php echo e($r->fecha->format('d/m/Y H:i')); ?></td>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->isAdministrador()): ?>
                                            <td>
                                                <form action="<?php echo e(route('fallas.destroy', $r->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-inbox fs-1"></i>
                    <p class="mt-2">No hay registros aún</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Steritex_Final\sistema\resources\views/fallas/index.blade.php ENDPATH**/ ?>