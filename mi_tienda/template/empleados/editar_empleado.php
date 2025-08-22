<?php
include '../../db/config.php';
include '../../includes/header.php';

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM empleados WHERE id = $id");
$empleado = $query->fetch_assoc();
?>

<div class="container mt-5">
    <div class="card p-4 shadow text-center">
        <h2 class="text-primary">Editar Empleado</h2>
        <p class="text-muted">Actualiza la información del empleado en el formulario a continuación.</p>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow-lg">
                <form action="funciones/actualizar_empleado.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $empleado['nombre']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="<?php echo $empleado['apellido']; ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="puesto" class="form-label">Puesto</label>
                            <input type="text" name="puesto" class="form-control" value="<?php echo $empleado['puesto']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo $empleado['telefono']; ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $empleado['email']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" value="<?php echo $empleado['fecha_ingreso']; ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="number" step="0.01" name="salario" class="form-control" value="<?php echo $empleado['salario']; ?>" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Actualizar Empleado</button>
                        <a href="../ver_empleados.php" class="btn btn-secondary btn-lg">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>