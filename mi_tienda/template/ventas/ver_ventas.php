<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../../db/config.php';
include '../../includes/header.php';

// Obtener datos para el gráfico de compras por día
$chartDataCompras = [];
$result = $conn->query("SELECT DATE(fecha) as fecha, COUNT(*) as total_compras FROM ventas GROUP BY DATE(fecha) ORDER BY fecha ASC");
while ($row = $result->fetch_assoc()) {
    $chartDataCompras[] = $row;
}

// Obtener datos para el gráfico de ganancias por día
$chartDataGanancias = [];
$result = $conn->query("SELECT DATE(fecha) as fecha, SUM(total) as total_ganancias FROM ventas GROUP BY DATE(fecha) ORDER BY fecha ASC");
while ($row = $result->fetch_assoc()) {
    $chartDataGanancias[] = $row;
}
?>

<body class="container mt-4">
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Panel de Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" href="../ventas.php">Volver a la Página Principal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="text-center mt-4">
    <h2 class="text-primary">📊 Lista de Ventas</h2>
    <p class="text-muted">Consulta y administra las ventas realizadas</p>
</div>

<div class="table-responsive mt-4">
    <table class="table table-hover table-bordered align-middle">
        <thead class="table">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM ventas ORDER BY fecha DESC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["producto"] . "</td>";
                echo "<td>" . "$" . " " . number_format($row["precio"], 2) . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "<td>" . "$" . " " . number_format($row["total"], 2) . "</td>";
                echo "<td>" . $row["cliente"] . "</td>";
                echo "<td>" . date("d/m/Y H:i", strtotime($row["fecha"])) . "</td>";
                echo "<td>";
                echo "<a href='actualizar_venta.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm me-1'>";
                echo "<i class='bi bi-pencil-square'></i> Actualizar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Gráficos -->
<div class="row mt-5">
    <div class="col-md-6">
        <h3 class="text-center">📈 Compras por Día</h3>
        <canvas id="comprasChart" width="400" height="200"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="text-center">💰 Ganancias por Día</h3>
        <canvas id="gananciasChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos para el gráfico de compras por día
    const chartDataCompras = <?php echo json_encode($chartDataCompras); ?>;
    const labelsCompras = chartDataCompras.map(data => data.fecha); // Fechas
    const dataCompras = chartDataCompras.map(data => data.total_compras); // Total de compras

    // Configuración del gráfico de compras por día
    const ctxCompras = document.getElementById('comprasChart').getContext('2d');
    new Chart(ctxCompras, {
        type: 'line', // Tipo de gráfico: línea
        data: {
            labels: labelsCompras,
            datasets: [{
                label: 'Compras por Día',
                data: dataCompras,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                borderColor: 'rgba(54, 162, 235, 1)', // Color de la línea
                borderWidth: 2,
                tension: 0.3 // Suaviza las líneas
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Cantidad de Compras'
                    },
                    beginAtZero: true // Inicia el eje Y en 0
                }
            },
            plugins: {
                legend: {
                    display: true // Muestra la leyenda
                },
                title: {
                    display: true,
                    text: 'Cantidad de Compras Realizadas por Día'
                }
            }
        }
    });

    // Datos para el gráfico de ganancias por día
    const chartDataGanancias = <?php echo json_encode($chartDataGanancias); ?>;
    const labelsGanancias = chartDataGanancias.map(data => data.fecha); // Fechas
    const dataGanancias = chartDataGanancias.map(data => data.total_ganancias); // Total de ganancias

    // Configuración del gráfico de ganancias por día
    const ctxGanancias = document.getElementById('gananciasChart').getContext('2d');
    new Chart(ctxGanancias, {
        type: 'line', // Tipo de gráfico: línea
        data: {
            labels: labelsGanancias,
            datasets: [{
                label: 'Ganancias por Día',
                data: dataGanancias,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de fondo
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea
                borderWidth: 2,
                tension: 0.3 // Suaviza las líneas
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Ganancias ($)'
                    },
                    beginAtZero: true // Inicia el eje Y en 0
                }
            },
            plugins: {
                legend: {
                    display: true // Muestra la leyenda
                },
                title: {
                    display: true,
                    text: 'Ganancias Generadas por Día'
                }
            }
        }
    });
</script>

</body>
<?php include '../../includes/footer.php'; ?>