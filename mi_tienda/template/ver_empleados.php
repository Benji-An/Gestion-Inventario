<?php
include '../db/config.php';
include '../includes/header.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Panel de Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" href="../index.php">Volver a la Página Principal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="card p-4 shadow text-center bg-light">
        <h2 class="fw-bold">Lista de Empleados</h2>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card p-3 shadow">
                <!-- Botón para agregar un nuevo empleado -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="empleados/historial_empleados.php" class="btn btn-info">
                        <i class="fas fa-history"></i> Ver Historial de Empleados
                    </a>
                    <a href="empleados/formulario_empleado.php" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Agregar Empleado
                    </a>
                </div>

                <!-- Mensaje de éxito -->
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_GET['mensaje']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Tabla de Empleados -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Puesto</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Fecha de Ingreso</th>
                                <th>Salario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Obtener lista de empleados
                            $query = $conn->query("SELECT * FROM empleados WHERE estado = 'activo'");
                            while ($row = $query->fetch_assoc()) {
                                $estado = $row['salario'] < 1423500 ? '⚠️ Bajo salario' : '✅ Adecuado';
                                ?>
                                <tr class="<?= $row['salario'] < 5000 ? 'table-warning' : '' ?>">
                                    <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido']) ?></td>
                                    <td><?= htmlspecialchars($row['puesto']) ?></td>
                                    <td><?= htmlspecialchars($row['telefono']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['fecha_ingreso']) ?></td>
                                    <td><?= htmlspecialchars($row['salario']) ?></td>
                                    <td><?= $estado ?></td>
                                    <td>
                                        <a href="empleados/editar_empleado.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="empleados/despedir_empleado.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?')">
                                            <i class="fas fa-trash-alt"></i> Despedir
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación (opcional, si hay muchos empleados) -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>