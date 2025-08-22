<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../db/config.php';
include '../includes/header.php';
?>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="../index.php">Volver a la Página Principal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-4 shadow text-center bg-primary text-white">
            <h2 class="fw-bold">Sección de Ventas</h2>
            <p class="text-white-50">Gestiona las ventas de manera eficiente desde esta sección.</p>
        </div>

        <div class="row mt-4">
            <!-- Tarjeta: Registrar Venta -->
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-cash-register text-success"></i> Registrar Venta</h3>
                        <p>Añade una nueva venta al sistema.</p>
                        <a href="ventas/registrar_venta.php" class="btn btn-outline-success btn-sm">Registrar Venta</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Ver Ventas -->
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-eye text-primary"></i> Ver Ventas</h3>
                        <p>Consulta el historial de ventas.</p>
                        <a href="ventas/ver_ventas.php" class="btn btn-outline-primary btn-sm">Ver Ventas</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Actualizar Venta -->
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-edit text-warning"></i> Actualizar Venta</h3>
                        <p>Modifica los detalles de una venta existente.</p>
                        <a href="ventas/actualizar_venta.php" class="btn btn-outline-warning btn-sm">Actualizar Venta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Mi Tienda. Todos los derechos reservados.</p>
    </footer>
</body>

<?php include '../includes/footer.php'; ?>