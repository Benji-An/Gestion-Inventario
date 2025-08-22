<!-- Registrar venta -->
<?php

include '../../db/config.php';
include '../../includes/header.php';
$productos = $conn->query("SELECT id, producto, stock_actual FROM compras WHERE stock_actual > 0");
?>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary" href="../ventas.php">Volver al Panel de Ventas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-4 shadow text-center">
            <h1 class="display-5 fw-bold">Registrar Venta</h1>
            <p class="text-muted">Complete el formulario para registrar una nueva venta.</p>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg">
                    <form action="funciones/registrar_venta.php" method="post">
                        <div class="mb-4">
                            <label for="producto_id" class="form-label fw-bold">Producto</label>
                            <select name="producto_id" class="form-select" required>
                                <option value="">Seleccione un producto</option>
                                <?php while($row = $productos->fetch_assoc()): ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= $row['producto']; ?> (Stock: <?= $row['stock_actual']; ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="precio" class="form-label fw-bold">Precio Unitario</label>
                            <input type="number" name="precio" step="0.01" class="form-control" placeholder="Ingrese el precio unitario" required>
                        </div>
                        <div class="mb-4">
                            <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" placeholder="Ingrese la cantidad" required>
                        </div>
                        <div class="mb-4">
                            <label for="metodo_pago" class="form-label fw-bold">Método de Pago</label>
                            <select name="metodo_pago" class="form-select" required onchange="toggleCuotasSection(this.value)">
                                <option value="">Seleccione un método de pago</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="cuotas">A Cuotas</option>
                            </select>
                        </div>
                        <div class="mb-4" id="cuotas_section" style="display: none;">
                            <label for="cuotas" class="form-label fw-bold">Número de Cuotas</label>
                            <input type="number" name="cuotas" class="form-control" placeholder="Ingrese el número de cuotas" min="1">
                        </div>
                        <div class="mb-4" id="monto_cuota_section" style="display: none;">
                            <label for="monto_cuota" class="form-label fw-bold">Monto por Cuota</label>
                            <input type="number" name="monto_cuota" class="form-control" placeholder="Ingrese el monto por cuota" step="0.01">
                        </div>
                        <script>
                        function toggleCuotasSection(value) {
                            const cuotasSection = document.getElementById('cuotas_section');
                            const montoCuotaSection = document.getElementById('monto_cuota_section');
                            if (value === 'cuotas') {
                                cuotasSection.style.display = 'block';
                                montoCuotaSection.style.display = 'block';
                            } else {
                                cuotasSection.style.display = 'none';
                                montoCuotaSection.style.display = 'none';
                            }
                        }
                        </script>
                        <div class="mb-4">
                            <label for="cliente" class="form-label fw-bold">Cliente</label>
                            <input type="text" name="cliente" class="form-control" placeholder="Nombre del cliente" required>
                        </div>
                        <div class="mb-4">
                            <label for="fecha" class="form-label fw-bold">Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Registrar Venta</button>
                        
                        <?php if (isset($_GET['venta']) && $_GET['venta'] == 'exitosa') : ?>
                            <div class="alert alert-success text-center mt-3">✅ Venta registrada correctamente.</div>
                        <?php endif; ?>
                        <?php if (isset($_GET['venta']) && $_GET['venta'] == 'error') : ?>
                            <div class="alert alert-danger text-center mt-3">❌ Error al registrar la venta.</div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body
