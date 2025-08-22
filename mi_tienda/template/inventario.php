<?php
include '../db/config.php';
include '../includes/header.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}

$busqueda = $_GET['buscar'] ?? '';

// Datos para tabla y gráfica
$stmt = $conn->prepare("
    SELECT 
        c.producto, 
        SUM(c.cantidad) AS total_comprado,
        IFNULL((SELECT SUM(v.cantidad) FROM ventas v WHERE v.producto = c.producto), 0) AS total_vendido
    FROM compras c
    WHERE c.producto LIKE ?
    GROUP BY c.producto
");
$like = "%$busqueda%";
$stmt->bind_param("s", $like);
$stmt->execute();
$resultado = $stmt->get_result();

// Guardamos datos para Chart.js
$productos = [];
$stocks = [];
$tabla = [];

while ($row = $resultado->fetch_assoc()) {
    $stock = $row['total_comprado'] - $row['total_vendido'];
    $productos[] = $row['producto'];
    $stocks[] = $stock;
    $tabla[] = [
        'producto' => $row['producto'],
        'total_comprado' => $row['total_comprado'],
        'total_vendido' => $row['total_vendido'],
        'stock' => $stock
    ];
}
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
            <h2 class="fw-bold">Inventario de Productos</h2>
            <p class="text-white-50">Administra y consulta el inventario de tus productos.</p>
        </div>

        <div class="card shadow p-4 mt-4">
            <!-- Buscador y Botón Exportar -->
            <form class="mb-4" method="GET">
                <div class="input-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." value="<?= htmlspecialchars($busqueda) ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                    <a href="inventario.php" class="btn btn-secondary">Limpiar</a>
                    <a href="exportar_excel.php" class="btn btn-success">Exportar a Excel</a>
                </div>
            </form>

            <!-- Tabla de Inventario -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Total Comprado</th>
                            <th>Total Vendido</th>
                            <th>Stock Disponible</th>
                            <th>Alerta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tabla as $row):
                            $alerta = $row['stock'] <= 5 ? '⚠️ Bajo stock' : '✅ Suficiente';
                            ?>
                            <tr class="<?= $row['stock'] <= 0 ? 'table-danger' : ($row['stock'] <= 5 ? 'table-warning' : '') ?>">
                                <td><?= htmlspecialchars($row['producto']) ?></td>
                                <td><?= $row['total_comprado'] ?></td>
                                <td><?= $row['total_vendido'] ?></td>
                                <td><?= $row['stock'] ?></td>
                                <td><?= $alerta ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Gráfico -->
            <div>
                <h4 class="mb-4 text-center text-success">Gráfico de Stock por Producto</h4>
                <canvas id="stockChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Mi Tienda. Todos los derechos reservados.</p>
    </footer>

    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($productos) ?>,
                datasets: [{
                    label: 'Stock Disponible',
                    data: <?= json_encode($stocks) ?>,
                    backgroundColor: <?= json_encode(array_map(fn($stock) => $stock <= 5 ? 'rgba(255, 99, 132, 0.6)' : 'rgba(54, 162, 235, 0.6)', $stocks)) ?>,
                    borderColor: <?= json_encode(array_map(fn($stock) => $stock <= 5 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)', $stocks)) ?>,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Productos'
                        }
                    }
                }
            }
        });
    </script>
</body>

<?php include '../includes/footer.php'; ?>

