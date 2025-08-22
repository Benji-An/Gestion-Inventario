<?php
include '../../../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $producto = trim($_POST['producto']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);
    $cliente = trim($_POST['cliente']);
    $fecha = $_POST['fecha'];
    $total = $precio * $cantidad;

    $stmt = $conn->prepare("UPDATE ventas SET producto=?, precio=?, cantidad=?, cliente=?, fecha=?, total=? WHERE id=?");
    $stmt->bind_param("sdissdi", $producto, $precio, $cantidad, $cliente, $fecha, $total, $id);

    if ($stmt->execute()) {
        header("Location: ../ver_ventas.php?actualizado=1");
        exit();
    } else {
        echo "❌ Error al actualizar la venta.";
    }
}
