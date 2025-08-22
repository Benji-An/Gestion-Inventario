<?php
include '../../../db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $puesto = $_POST['puesto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salario = $_POST['salario'];

    $sql = "INSERT INTO empleados (nombre, apellido, puesto, telefono, email, fecha_ingreso, salario)
            VALUES ('$nombre', '$apellido', '$puesto', '$telefono', '$email', '$fecha_ingreso', '$salario')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Empleado registrado correctamente');</script>";
        echo "<script>window.location.href = '../../ver_empleados.php';</script>";
    } else {
        echo "Error al registrar el empleado: " . $conn->error;
    }
}
?>
