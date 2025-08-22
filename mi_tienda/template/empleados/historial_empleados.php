<?php
include('../../db/config.php');

// Obtener lista de empleados despedidos
$query = $conn->query("SELECT nombre, apellido, puesto, telefono, email, fecha_ingreso, fecha_despido, salario, estado FROM empleados WHERE estado = 'despedido'");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
} 

?>

<?php include '../../includes/header.php'; ?>
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
<body>
    <div class="container mt-5">
    <div class="card p-4 shadow text-center bg-light">
        <h2 class="fw-bold">Lista de Empleados Despedidos</h2>
    </div>
        <div class="table-responsive mb-4 mt-4">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Puesto</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Despido</th>
                        <th>Salario</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $query->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['apellido']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puesto']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['telefono']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['fecha_ingreso']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['fecha_despido']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['salario']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['estado']) . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<?php include '../../includes/footer.php'; ?>