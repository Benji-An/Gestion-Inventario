<!-- Registrar compra -->
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../../db/config.php';
include '../../includes/header.php';
?>
<body>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../compras.php">Volver al Panel de Compras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg border-0">
            <h2 class="text-center text-primary">Registrar Compra</h2>
            <p class="text-center text-muted">Complete el formulario para registrar una nueva compra.</p>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg border-0">
                    <form action="funciones/registro_compra.php" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="producto" class="form-label">Producto</label>
                                <input type="text" name="producto" class="form-control" placeholder="Nombre del producto" required>
                            </div>
                            <div class="col-md-6">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" name="precio" class="form-control" placeholder="Precio en COP" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" placeholder="Cantidad adquirida" required>
                            </div>
                            <div class="col-md-6">
                                <label for="proveedor" class="form-label">Proveedor</label>
                                <input type="text" name="proveedor" class="form-control" placeholder="Nombre del proveedor" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary w-100">Registrar Compra</button>
                        </div>
                        <?php if (isset($_GET['compra']) && $_GET['compra'] == 'exitosa') : ?>
                            <div class="alert alert-success text-center mt-3">✅ Compra registrada exitosamente.
                                <a href="ver_compras.php" class="btn btn-sm btn-outline-success">Ver Compras</a>
                            </div>
                        <?php elseif (isset($_GET['compra']) && $_GET['compra'] == 'error') : ?>
                            <div class="alert alert-danger text-center mt-3">❌ Error al registrar la compra.</div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include '../../includes/footer.php'; ?>