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
            <a class="navbar-brand" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Volver a la Página Principal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-4 shadow text-center bg-primary text-white">
            <h2 class="fw-bold">Sección de Compras</h2>
            <p class="text-white-50">Administra tus compras de manera eficiente</p>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-plus-circle text-success"></i> Registrar Compra</h3>
                        <p>Registra nuevas compras fácilmente.</p>
                        <a href="compras/registrar_compra.php" class="btn btn-outline-success btn-sm">Registrar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-eye text-primary"></i> Ver Compras</h3>
                        <p>Consulta el historial de compras realizadas.</p>
                        <a href="compras/ver_compras.php" class="btn btn-outline-primary btn-sm">Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow text-center border-0">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="fas fa-pencil-alt text-warning"></i> Actualizar Compra</h3>
                        <p>Modifica los detalles de tus compras.</p>
                        <a href="compras/actualizar_compra.php" class="btn btn-outline-warning btn-sm">Actualizar</a>
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