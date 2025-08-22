<!-- Actualizar compra -->
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../../../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $producto = trim($_POST["producto"]);
    $precio = floatval($_POST["precio"]);
    $cantidad = intval($_POST["cantidad"]);
    $proveedor = trim($_POST["proveedor"]);
    $fecha = $_POST["fecha"];

    // Calcular el total
    $total = $precio * $cantidad;

    // Actualizar datos en la tabla compras
    $stmt = $conn->prepare("UPDATE compras SET producto = ?, precio = ?, cantidad = ?, proveedor = ?, fecha = ?, total = ? WHERE id = ?");
    $stmt->bind_param("sdissdi", $producto, $precio, $cantidad, $proveedor, $fecha, $total, $id);

    if ($stmt->execute()) {
        header("Location: ../ver_compras.php?actualizacion=exitosa");
        exit();
    } else {
        echo "Error al actualizar la compra.";
    }

    $stmt->close();
}
?>