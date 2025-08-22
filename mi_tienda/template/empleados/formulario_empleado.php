<?php
include '../../db/config.php';
include '../../includes/header.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary" href="../ver_empleados.php">Volver al Panel de empleados</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">
    <div class="card p-4 shadow text-center bg-primary text-white">
        <h2>Registrar Empleado</h2>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow">
                <form action="funciones/registrar_empleado.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="puesto" class="form-label">Puesto</label>
                            <input type="text" name="puesto" class="form-control" placeholder="Ingrese el puesto" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese el email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario</label>
                        <input type="number" step="0.01" name="salario" class="form-control" placeholder="Ingrese el salario" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-50">Registrar Empleado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>