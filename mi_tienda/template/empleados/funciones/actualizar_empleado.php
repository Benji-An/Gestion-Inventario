<?php
include '../../../db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $puesto = $_POST['puesto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salario = $_POST['salario'];

    $sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', puesto='$puesto', telefono='$telefono', email='$email', fecha_ingreso='$fecha_ingreso', salario='$salario' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Empleado actualizado correctamente');</script>";
        echo "<script>window.location.href = '../../ver_empleados.php';</script>";
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
    }
}
?>
