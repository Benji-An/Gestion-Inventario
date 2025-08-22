<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: auth/login.php");
    exit();
}

include 'db/config.php';
include 'includes/header.php';
?>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Tienda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                </ul>
                <a href="auth/logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-4 shadow text-center bg-primary text-white">
            <h2>Bienvenido, <?php echo $_SESSION["usuario"]; ?></h2>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card p-3 shadow text-center">
                    <h3><i class="fas fa-shopping-cart text-success"></i> Sección de Compras</h3>
                    <p>En esta sección podrás registrar, ver y actualizar tus compras.</p>
                    <a href="template/compras.php" class="btn btn-sm btn-outline-success">Ver sección de Compras</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow text-center">
                    <h3><i class="fas fa-chart-line text-primary"></i> Sección de Ventas</h3>
                    <p>En esta sección podrás registrar, ver y actualizar tus ventas.</p>
                    <a href="template/ventas.php" class="btn btn-sm btn-outline-primary">Ver sección de Ventas</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 shadow text-center">
                    <h3><i class="fas fa-boxes text-warning"></i> Inventario</h3>
                    <p>En esta sección podrás ver el inventario de tus productos.</p>
                    <a href="template/inventario.php" class="btn btn-sm btn-outline-warning">Ver Inventario</a>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card p-3 shadow text-center">
                    <h3><i class="fas fa-users text-info"></i> Información de los empleados</h3>
                    <p>En esta sección podrás ver la información de los empleados y sus pagos.</p>
                    <a href="template/ver_empleados.php" class="btn btn-sm btn-outline-info">Ver información</a>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include 'includes/footer.php';
?>