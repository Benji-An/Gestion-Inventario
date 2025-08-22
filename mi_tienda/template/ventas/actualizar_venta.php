<?php
include '../../db/config.php';
include '../../includes/header.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="bi bi-shop"></i> Panel de Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../ventas.php"><i class="bi bi-arrow-left-circle"></i> Volver al Panel de Ventas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow text-center bg-light">
        <h2 class="text-primary"><i class="bi bi-pencil-square"></i> Editar Venta</h2>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card p-4 shadow-sm">
                <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->prepare("SELECT * FROM ventas WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $venta = $result->fetch_assoc();
                ?>
                <form action="funciones/actualizar_venta.php" method="post">
                    <input type="hidden" name="id" value="<?= $venta['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-box"></i> Producto</label>
                        <input type="text" name="producto" class="form-control" value="<?= $venta['producto']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-currency-dollar"></i> Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="<?= $venta['precio']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-cart"></i> Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" value="<?= $venta['cantidad']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-person"></i> Cliente</label>
                        <input type="text" name="cliente" class="form-control" value="<?= $venta['cliente']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-calendar"></i> Fecha</label>
                        <input type="date" name="fecha" class="form-control" value="<?= $venta['fecha']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Actualizar Venta</button>
                        <a href="ver_ventas.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</a>
                    </div>
                </form>
                <?php
                    } else {
                        echo "<div class='alert alert-danger text-center'>
                        ❌ No se ha seleccionado ninguna compra para actualizar.
                        <a href='ver_ventas.php' class='btn btn-sm btn-outline-danger mt-2'><i class='bi bi-eye'></i> Ver ventas</a>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
