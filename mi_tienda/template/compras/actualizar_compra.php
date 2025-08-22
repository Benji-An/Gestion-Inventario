<!-- Actualizar Compra -->
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Panel de Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../compras.php">Volver a la Página Principal del Panel de Compras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="mb-4">Actualizar Compra</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Formulario de Actualización</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $stmt = $conn->prepare("SELECT * FROM compras WHERE id = ?");
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                        ?>
                        <form action="funciones/actualizar_compra.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-floating mb-3">
                                <input type="text" name="producto" class="form-control" id="producto" value="<?php echo $row['producto']; ?>" required>
                                <label for="producto">Producto</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="precio" class="form-control" id="precio" value="<?php echo $row['precio']; ?>" required>
                                <label for="precio">Precio</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="cantidad" class="form-control" id="cantidad" value="<?php echo $row['cantidad']; ?>" required>
                                <label for="cantidad">Cantidad</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="proveedor" class="form-control" id="proveedor" value="<?php echo $row['proveedor']; ?>" required>
                                <label for="proveedor">Proveedor</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="fecha" class="form-control" id="fecha" value="<?php echo $row['fecha']; ?>" required>
                                <label for="fecha">Fecha</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Actualizar Compra</button>
                        </form>
                        <?php
                        } else {
                            echo "<div class='alert alert-warning text-center'>
                            ❌ No se ha seleccionado ninguna compra para actualizar.
                            <a href='ver_compras.php' class='btn btn-sm btn-outline-warning mt-2'>Ver Compras</a>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include '../../includes/footer.php'; ?>